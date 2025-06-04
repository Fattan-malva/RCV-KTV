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
        $rooms = \App\Models\Room::all(); // Ambil semua room
        return view('admin.rooms.booking', compact('bookinglist', 'rooms'));
    }

    public function store(Request $request)
    {
        // Generate TrxId otomatis
        $trxId = 'TRX-' . str_replace(['-', ' ', ':', '.'], '', now()->format('Y-m-d H:i:s.u'));

        // Gabungkan TrxId ke request
        $request->merge(['TrxId' => $trxId]);

        $validated = $request->validate([
            'TrxId' => 'required',
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

    public function edit($TrxId)
    {
        $booking = TrxRoomBooking::where('TrxId', $TrxId)->firstOrFail();
        return response()->json($booking);
    }

    public function update(Request $request, $TrxId)
    {
        $validated = $request->validate([
            'RoomId' => 'required',
            'GuestName' => 'required',
            'TimeIn' => 'required',
            'Notes' => 'nullable',
            'BookPack' => 'nullable',
        ]);
        TrxRoomBooking::where('TrxId', $TrxId)->update($validated);
        return response()->json(['success' => true]);
    }

    public function destroy($TrxId)
    {
        TrxRoomBooking::where('TrxId', $TrxId)->delete();
        return response()->json(['success' => true]);
    }
}