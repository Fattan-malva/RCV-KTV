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