<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrxRoomDetail;
use Illuminate\Http\Request;

class TrxRoomDetailController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->query('date');
        $typecheckin = $request->query('typecheckin');

        if ($date) {
            $query = TrxRoomDetail::where('TrxDate', $date);
            if ($typecheckin === 'guest') {
                $query->whereIn('TypeCheckIn', [2, 3]);
            }
            $trxRoomDetails = $query->get();
        } else {
            $trxRoomDetails = TrxRoomDetail::all();
        }
        return view('admin.rooms.detail', compact('trxRoomDetails', 'date'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'TrxDate' => 'required|date',
            'CheckInTime' => 'required',
            'CheckOutTime' => 'nullable',
            'TrxId' => 'required',
            'RoomId' => 'required',
            'GuestId' => 'nullable',
            'GuestName' => 'required',
            'Notes' => 'nullable',
        ]);
        TrxRoomDetail::create($validated);
        return redirect()->route('admin.rooms.detail')->with('success', 'Room transaction added!');
    }

    public function destroy($id)
    {
        TrxRoomDetail::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
}