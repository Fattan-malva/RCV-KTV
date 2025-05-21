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
        $categories = RoomCategory::all(); // Jika Anda punya kategori ruangan
        return response()->json([
            'room' => $room,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:rooms,name,' . $id,
            'room_category_id' => 'required|exists:room_categories,id',
            'capacity' => 'required|integer|min:1',
            'available' => 'required|integer',
        ]);

        $room = Room::findOrFail($id);
        $room->update($request->all());

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
