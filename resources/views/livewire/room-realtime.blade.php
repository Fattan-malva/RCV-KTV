<div class="card container-room mb-4" wire:poll.5s>
    @php
        $groupedRooms = $rooms->groupBy(function($room) {
            return $room->category ? $room->category->name : 'Uncategorized';
        })->sortKeys();
    @endphp

    @foreach($groupedRooms as $categoryName => $categoryRooms)
        <h4 class="mb-4 mt-4">{{ $categoryName }}</h4>
        <div>
            @forelse($categoryRooms as $room)
                @if(in_array($room->available, [1, 3, 5, 2, 4, 6, 7]))
                @php
                    $nextBooking = $upcomingBookings[$room->roomId][0] ?? null;
                    $isBlinking = false;
                    if ($nextBooking) {
                        $timeIn = \Carbon\Carbon::parse($nextBooking->TimeIn);
                        $now = \Carbon\Carbon::now();
                        $isBlinking = $timeIn->greaterThan($now) && $timeIn->diffInMinutes($now) <= 60;
                    }
                @endphp    
                <div class="room-card edit-room
                            @if(in_array($room->available, [1, 3,5, 7])) available-room
                            @elseif($room->available == 2) unavailable-room
                            @elseif($room->available == 4) mntc-room
                            @elseif($room->available == 6) oo-room
                            @else unavailable-room @endif
                            @if($isBlinking) blinking-room @endif"
                            data-id="{{ $room->id }}">
                        <div style="display: flex; flex-direction: column; align-items: flex-start;">
                            <div>
                                <i class="fas fa-door-closed room-icon"></i>
                                <span class="room-name">{{ $room->name }}</span>
                            </div>
                                @if($room->currentTrx && $room->currentTrx->GuestName)
                                    <div style="font-size: 12px; font-weight: bold; margin-top: 4px; text-align: center;">
                                        <i class="fa fa-user"></i> {{ $room->currentTrx->GuestName }}
                                    </div>
                                @else
                                    <div style="font-size: 16px; font-weight: bold; margin-top: 4px; text-align: center; color: #28a745;">
                                        Idle
                                    </div>
                                @endif
                        </div>
                    </div>
                @endif
            @empty
                <p>No rooms available based on the selected filters.</p>
            @endforelse
        </div>
    @endforeach

    <div class="legend" style="margin-top: 10%;">
        <div class="legend-card available-legend">
            <i class="fas fa-door-closed legend-icon"></i>
            <span class="legend-name">Available</span>
        </div>
        <div class="legend-card unavailable-legend">
            <i class="fas fa-door-closed legend-icon"></i>
            <span class="legend-name">Used</span>
        </div>
        <div class="legend-card mntc-legend">
            <i class="fas fa-door-closed legend-icon"></i>
            <span class="legend-name">Maintenance</span>
        </div>
        <div class="legend-card oo-legend">
            <i class="fas fa-door-closed legend-icon"></i>
            <span class="legend-name">OO</span>
        </div>
    </div>
</div>