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
}