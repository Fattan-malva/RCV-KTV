<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\RoomCategory;
use Illuminate\Http\Request;

class RoomCategoryController extends Controller
{
    public function index()
    {
        $categories = RoomCategory::all();
        return view('room_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('room_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|unique:room_categories',
            'name' => 'required|unique:room_categories',
            'description' => 'nullable',
        ]);

        RoomCategory::create($request->all());
        if ($request->has('create_another')) {
            return redirect()->route('admin.rooms')->with('success', 'Categories added successfully!')->with('create_another', true);
        }
        return redirect()->route('admin.rooms')->with('success', 'Categories added successfully.');
    }

    public function edit(RoomCategory $roomCategory)
    {
        return view('room_categories.edit', compact('roomCategory'));
    }

    public function update(Request $request, RoomCategory $roomCategory)
    {
        $request->validate([
            'name' => 'required|unique:room_categories,name,' . $roomCategory->id,
            'description' => 'nullable',
        ]);

        $roomCategory->update($request->all());
        return redirect()->route('room_categories.index')->with('success', 'Category updated successfully.');
    }
    public function destroy($id)
    {
        $roomCategory = RoomCategory::find($id);

        if (!$roomCategory) {
            return redirect()->route('admin.rooms')->with('error', 'Category not found.');
        }

        // Cek apakah kategori terkait dengan room
        if ($roomCategory->rooms()->count() > 0) {
            return redirect()->route('admin.rooms')->with('error', 'This category cannot be deleted because it is associated with rooms.');
        }

        $roomCategory->delete();
        return redirect()->route('admin.rooms')->with('success', 'Category deleted successfully.');
    }

}
