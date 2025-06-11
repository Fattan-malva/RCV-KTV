<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\TrxRoomDetail;
use App\Models\TrxRoomBooking;

class RoomRealtime extends Component
{
    public function render()
    {
        $rooms = Room::with(['category', 'currentTrx'])->get();
        $categories = RoomCategory::all();
        $availableRoomCount = Room::whereIn('available', [1, 3, 5, 7])->count();
        $unavailableRoomCount = Room::whereIn('available', [2, 4, 6])->count();
        $allRoomCount = Room::count();
        $roomToday = TrxRoomDetail::where('TrxDate', now()->format('Y-m-d'))
            ->whereIn('TypeCheckIn', [2, 3])
            ->count();
        $upcomingBookings = TrxRoomBooking::where('TimeIn', '>=', now())
            ->orderBy('TimeIn')
            ->get()
            ->groupBy('RoomId');

        return view('livewire.room-realtime', [
            'rooms' => $rooms,
            'categories' => $categories,
            'availableRoomCount' => $availableRoomCount,
            'unavailableRoomCount' => $unavailableRoomCount,
            'allRoomCount' => $allRoomCount,
            'roomToday' => $roomToday,
            'upcomingBookings' => $upcomingBookings,
        ]);
    }
}