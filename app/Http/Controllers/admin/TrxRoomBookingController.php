<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrxRoomBooking;
use Illuminate\Http\Request;

class TrxRoomBookingController extends Controller
{
    public function index()
    {
        $bookinglist = TrxRoomBooking::all();
        return view('admin.rooms.booking', compact('bookinglist'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'TrxId' => 'required',
            'TrxDate' => 'required|date',
            'TrxTime' => 'required',
            'RoomId' => 'required',
            'GuestId' => 'nullable',
            'GuestName' => 'required',
            'TimeIn' => 'required', 
            'Notes' => 'nullable',
            'BookPack' => 'nullable',
        ]);

        TrxRoomBooking::create($validated);
        return redirect()->route('admin.rooms.booking')->with('success', 'Booking List added!');
    }

    public function destroy($id)
    {
        TrxRoomBooking::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
}