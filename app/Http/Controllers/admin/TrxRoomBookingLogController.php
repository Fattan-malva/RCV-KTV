<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrxRoomBookingLog;
use Illuminate\Http\Request;

class TrxRoomBookingLogController extends Controller
{
    public function allLogs()
    {
        $twoMonthsAgo = now()->subMonths(2);

        $logs = \App\Models\TrxRoomBookingLog::where('TrxDate', '>=', $twoMonthsAgo)->get();
        return response()->json($logs);
    }
    public function print(Request $request)
    {
        $mode = $request->mode_cb;
        $query = \App\Models\TrxRoomBookingLog::query();
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
        $bookingCancellist = $query->orderBy('TrxDate')->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.rooms.print-booking-cancel', [
            'bookingCancellist' => $bookingCancellist,
            'info' => $info,
        ])->setPaper('A4', 'portrait'); // <-- gunakan portrait di sini

        return $pdf->stream('bookingCancel-report.pdf');
    }
}