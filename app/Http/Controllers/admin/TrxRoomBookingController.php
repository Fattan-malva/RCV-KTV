<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrxRoomBooking;
use App\Models\TrxRoomBookingLog;
use Illuminate\Http\Request;

class TrxRoomBookingController extends Controller
{
    public function index()
    {
        $now = now();

        $twoMonthsAgo = now()->subMonths(2);

        $bookinglist = \App\Models\TrxRoomBooking::where('TrxDate', '>=', $twoMonthsAgo)
            ->orderByRaw(
                "CASE WHEN TimeIn >= ? THEN 0 ELSE 1 END, TimeIn ASC",
                [$now]
            )->get();

        $rooms = \App\Models\Room::all();
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
            'ReservationWith' => 'required',
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
            'ReservationWith' => 'required',
            'TimeIn' => 'required',
            'Notes' => 'nullable',
            'BookPack' => 'nullable',
        ]);
        TrxRoomBooking::where('TrxId', $TrxId)->update($validated);
        return response()->json(['success' => true]);
    }

    public function destroy(Request $request, $TrxId)
    {
        $reason = $request->input('Reason');
        if (!$reason) {
            return response()->json(['success' => false, 'message' => 'Reason is required'], 422);
        }

        $booking = TrxRoomBooking::where('TrxId', $TrxId)->first();
        if ($booking) {
            // Simpan ke log
            TrxRoomBookingLog::create([
                'TrxId' => $booking->TrxId,
                'TrxDate' => $booking->TrxDate,
                'TrxTime' => $booking->TrxTime,
                'RoomId' => $booking->RoomId,
                'GuestId' => $booking->GuestId,
                'GuestName' => $booking->GuestName,
                'ReservationWith' => $booking->ReservationWith,
                'TimeIn' => $booking->TimeIn,
                'Reason' => $reason,
            ]);
            $booking->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Booking not found'], 404);
    }
}