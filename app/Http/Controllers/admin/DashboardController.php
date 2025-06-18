<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TrxRoomBooking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\TrxRoomDetail;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the landing page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $availableRoomCount = Room::whereIn('available', [1, 3, 5, 7])->count();
        $unavailableRoomCount = Room::whereIn('available', [2, 4, 6])->count();
        $bookingList = TrxRoomBooking::where('TimeIn', '>=', Carbon::now()->toDateString())->count();
        $guestToday = TrxRoomDetail::where('TrxDate', now()->format('Y-m-d'))
            ->where('TypeCheckIn', [2, 3])
            ->count();
        $checkinReport = TrxRoomDetail::selectRaw('MONTH(CheckInTime) as month, COUNT(*) as total')
            ->whereNotNull('CheckInTime')
            ->whereIn('TypeCheckIn', [2, 3])
            ->groupBy(\DB::raw('MONTH(CheckInTime)'))
            ->orderBy(\DB::raw('MONTH(CheckInTime)'))
            ->pluck('total', 'month')
            ->toArray();
        $now = now();
        $bookinglistData = TrxRoomBooking::where('TimeIn', '>=', $now)
            ->orderBy('TimeIn', 'asc')
            ->get();

        $guestCheckinData = TrxRoomDetail::where('TrxDate', now()->format('Y-m-d'))
            ->whereIn('TypeCheckIn', [2, 3])
            ->get();

        return view('admin.dashboard', compact(
            'availableRoomCount',
            'unavailableRoomCount',
            'bookingList',
            'guestToday',
            'checkinReport',
            'bookinglistData',
            'guestCheckinData'
        ));
    }
}
