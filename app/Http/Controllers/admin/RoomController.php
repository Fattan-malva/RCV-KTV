<?php


namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Http\Request;
class RoomController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::query();

        if ($request->has('category') && $request->category != '') {
            $query->where('room_category_id', $request->category);
        }

        if ($request->has('availability') && $request->availability != '') {
            if ($request->availability == 'available') {
                $query->whereIn('available', [1, 3, 5, 7]);
            } elseif ($request->availability == 'unavailable') {
                $query->whereIn('available', [2, 4, 6]);
            }
        }

        if ($request->has('capacity') && $request->capacity != '') {
            $query->where('capacity', $request->capacity);
        }

        $rooms = $query->with('category')->get();
        $categories = RoomCategory::all();

        $availableRoomCount = Room::whereIn('available', [1, 3, 5, 7])->count();
        $unavailableRoomCount = Room::whereIn('available', [2, 4, 6])->count();
        $allRoomCount = Room::count();


        return view('admin.rooms.index', compact('rooms', 'categories', 'availableRoomCount', 'unavailableRoomCount', 'allRoomCount'));
    }




    public function create()
    {
        $categories = RoomCategory::all();
        return view('admin.rooms.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'roomId' => 'required|string|unique:rooms,roomId',
            'name' => 'required|unique:rooms',
            'room_category_id' => 'required|exists:room_categories,id',
            'capacity' => 'required|integer|min:1',
            'available' => '1',
        ]);

        Room::create($request->all());
        // Check if the "Create & Another" button was pressed
        if ($request->has('create_another')) {
            return redirect()->route('admin.rooms')->with('success', 'Room added successfully!')->with('create_another', true);
        }
        return redirect()->route('admin.rooms')->with('success', 'Room created successfully.');
    }
    public function edit($id)
    {
        $room = Room::findOrFail($id);
        $categories = RoomCategory::all();

        // Ambil trx terakhir yang belum checkout (CheckOutTime null)
        $trx = \App\Models\TrxRoomDetail::where('RoomId', $room->roomId)
            ->whereNull('CheckOutTime')
            ->orderByDesc('TrxDate')
            ->first();

        return response()->json([
            'room' => $room,
            'categories' => $categories,
            'trx' => $trx,
        ]);
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:rooms,name,' . $id,
        'room_category_id' => 'required|exists:room_categories,id',
        'capacity' => 'required|integer|min:1',
        'available' => 'required|integer',
        'guest_name' => 'nullable|string|max:255',
        'notes' => 'nullable|string|max:255',
    ]);

    $room = Room::findOrFail($id);
    $room->update($request->all());

    $roomId = $room->roomId;
    $status = (int) $request->available;

    // Check-in (Guest/Host/Maintenance/OO)
    if (in_array($status, [2, 4, 6])) {
        $trx = \App\Models\TrxRoomDetail::where('RoomId', $roomId)
            ->whereNull('CheckOutTime')
            ->first();
        if (!$trx) {
            // Generate TrxId unik (varchar acak)
            $trxId = 'TRX-' . strtoupper(bin2hex(random_bytes(8)));
            \App\Models\TrxRoomDetail::create([
                'TrxId' => $trxId,
                'TrxDate' => now()->format('Y-m-d'),
                'CheckInTime' => now(),
                'RoomId' => $roomId,
                'GuestName' => $request->guest_name,
                'Notes' => $request->notes,
            ]);
        }
    }
    // Check-out (Guest/Host/Maintenance/OO)
    if (in_array($status, [3, 5, 7])) {
        // Gunakan query builder agar tidak butuh primary key
        \DB::table('TrxRoomDetail')
            ->where('RoomId', $roomId)
            ->whereNull('CheckOutTime')
            ->update([
                'CheckOutTime' => now(),
                'GuestName' => $request->guest_name,
                'Notes' => $request->notes,
            ]);
    }

    if ($request->ajax()) {
        return response()->json(['success' => true, 'message' => 'Room updated successfully.']);
    }
    return redirect()->back()->with('success', 'Room updated successfully.');
}



    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Room deleted successfully.');
    }
}
