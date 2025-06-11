<?php


namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Http\Request;
use App\Models\TrxRoomDetail;
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

        $rooms = $query->with(['category', 'currentTrx'])->get();
        $categories = RoomCategory::all();

        $availableRoomCount = Room::whereIn('available', [1, 3, 5, 7])->count();
        $unavailableRoomCount = Room::whereIn('available', [2, 4, 6])->count();
        $allRoomCount = Room::count();
        $roomToday = TrxRoomDetail::where('TrxDate', now()->format('Y-m-d'))
            ->where('TypeCheckIn', [2, 3])
            ->count();


        $upcomingBookings = \App\Models\TrxRoomBooking::where('TimeIn', '>=', now())
            ->orderBy('TimeIn')
            ->get()
            ->groupBy('RoomId');

        return view('admin.rooms.index', compact(
            'rooms',
            'categories',
            'availableRoomCount',
            'unavailableRoomCount',
            'allRoomCount',
            'roomToday',
            'upcomingBookings'
        ));
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

        $trx = \App\Models\TrxRoomDetail::where('RoomId', $room->roomId)
            ->whereNull('CheckOutTime')
            ->orderByDesc('TrxDate')
            ->first();

        // Hanya ambil booking yang TimeIn >= sekarang
        $bookings = \App\Models\TrxRoomBooking::where('RoomId', $room->roomId)
            ->where('TimeIn', '>=', now())
            ->orderBy('TimeIn', 'asc')
            ->get(['GuestName', 'TimeIn']);

        return response()->json([
            'room' => $room,
            'categories' => $categories,
            'trx' => $trx,
            'bookings' => $bookings,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:rooms,name,' . $id,
            'room_category_id' => 'required|exists:room_categories,id',
            'capacity' => 'required|integer|min:1',
            'available' => 'required|integer',
            'guest_name' => 'required|string|max:255',
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
                $trxId = 'TRX-' . str_replace(['-', ' ', ':', '.'], '', now()->format('Y-m-d H:i:s.u'));
                \App\Models\TrxRoomDetail::create([
                    'TrxId' => $trxId,
                    'TrxDate' => now()->format('Y-m-d'),
                    'CheckInTime' => now(),
                    'TypeCheckIn' => $status,
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
