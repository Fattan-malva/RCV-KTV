<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrxRoomBooking;
use App\Models\TrxRoomBookingLog;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function print(Request $request)
    {
        $mode = $request->mode;
        $query = \App\Models\TrxRoomBooking::query();
        $info = '';

        if ($mode === 'range') {
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);
            $query->whereBetween('TrxDate', [$request->start_date, $request->end_date]);

            $start = \Carbon\Carbon::parse($request->start_date)->format('d M Y');
            $end = \Carbon\Carbon::parse($request->end_date)->format('d M Y');
            $info = "Report data from <strong>{$start}</strong> to <strong>{$end}</strong>";
        } elseif ($mode === 'monthly') {
            $request->validate([
                'month' => 'required|numeric|min:1|max:12',
                'year' => 'required|numeric',
            ]);
            $query->whereYear('TrxDate', $request->year)
                ->whereMonth('TrxDate', $request->month);

            $monthName = \Carbon\Carbon::create()->month($request->month)->format('F');
            $info = "Report data for the month of <strong>{$monthName}</strong>, <strong>{$request->year}</strong>";
        }

        $bookinglist = $query->orderBy('TrxDate')->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.rooms.print-booking', [
            'bookinglist' => $bookinglist,
            'info' => $info,
        ])->setPaper('A4', 'portrait'); // <-- gunakan portrait di sini

        return $pdf->stream('booking-report.pdf');
    }

}