<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrxRoomDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TrxRoomDetailController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->query('date');
        $typecheckin = $request->query('typecheckin');

        // Tambahan: Ambil tanggal 2 bulan terakhir dari sekarang
        $twoMonthsAgo = now()->subMonths(2)->format('Y-m-d');

        if ($date) {
            $query = TrxRoomDetail::where('TrxDate', $date);
            if ($typecheckin === 'guest') {
                $query->whereIn('TypeCheckIn', [2, 3]);
            }
            // Filter hanya data 2 bulan terakhir
            $query->where('TrxDate', '>=', $twoMonthsAgo);
            $trxRoomDetails = $query->get();
        } else {
            // Filter hanya data 2 bulan terakhir
            $trxRoomDetails = TrxRoomDetail::where('TrxDate', '>=', $twoMonthsAgo)
                ->orderBy('TrxDate', 'desc')
                ->get();
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
            'ReservationWith' => 'required',
            'TaxPackage' => 'required',
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

    public function print(Request $request)
    {
        $mode = $request->mode;
        $query = \App\Models\TrxRoomDetail::query();
        $info = '';

        if ($mode === 'range') {
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);
            $query->whereBetween('TrxDate', [$request->start_date, $request->end_date]);

            $start = \Carbon\Carbon::parse($request->start_date)->format('d M Y');
            $end = \Carbon\Carbon::parse($request->end_date)->format('d M Y');
            $info = "Data dari tanggal <strong>{$start}</strong> sampai <strong>{$end}</strong>";
        } elseif ($mode === 'monthly') {
            $request->validate([
                'month' => 'required|numeric|min:1|max:12',
                'year' => 'required|numeric',
            ]);
            $query->whereYear('TrxDate', $request->year)
                ->whereMonth('TrxDate', $request->month);

            $monthName = \Carbon\Carbon::create()->month($request->month)->format('F');
            $info = "Data bulan <strong>{$monthName}</strong> tahun <strong>{$request->year}</strong>";
        }

        $detaillist = $query->orderBy('TrxDate')->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.rooms.print-detail', [
            'detaillist' => $detaillist,
            'info' => $info,
        ])->setPaper('A4', 'portrait'); 

        return $pdf->stream('detail-report.pdf');
    }
}