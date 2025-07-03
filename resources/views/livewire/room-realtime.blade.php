@php
    use Carbon\Carbon;
    $anyBlinking = false;
    foreach ($rooms as $room) {
        $nextBooking = $upcomingBookings[$room->roomId][0] ?? null;
        $isBlinking = false;
        if ($nextBooking) {
            $timeIn = $nextBooking->TimeIn ? Carbon::parse($nextBooking->TimeIn) : null;
            $now = now();
            // Expired uncheck-in: IsCheckedIn == 0 dan sudah lewat 3 jam dari TimeIn
            $isExpiredUncheckin = ($nextBooking->IsCheckedIn == 0) &&
                $timeIn &&
                $timeIn->copy()->addHours(3)->lt($now);

            // BLINK: jika belum check-in, belum expired uncheck-in, dan sudah masuk 1 jam sebelum TimeIn
            if (
                ($nextBooking->IsCheckedIn == 0) &&
                !$isExpiredUncheckin &&
                $timeIn &&
                $timeIn->diffInMinutes($now, false) >= -60
            ) {
                $isBlinking = true;
            }
        }
        if ($isBlinking) {
            $anyBlinking = true;
            break;
        }
    }
@endphp
<div>
    <div class="row">
        <div class="col-12 mb-3">
            @if($anyBlinking)
                <div class="mini-blink-alert" style="margin-bottom:10px;">
                    <i class="fa fa-bell"></i> Booking soon!
                </div>
            @endif
            <div class="card-container">
                <!-- Available Rooms Card -->
                <div class="card small" wire:click="setAvailability('available')" style="cursor:pointer;">
                    <div class="d-flex justify-content-between align-items-center" id="available-icon" data-availability="1">
                        <div class="left-content">
                            <h5>Available</h5>
                            <p>{{ $availableRoomCount }} Rooms</p>
                        </div>
                        <div class="right-content-available">
                            <i class="fas fa-couch" id="room-icon" data-availability="1"></i>
                        </div>
                    </div>
                </div>

                <!-- Unavailable Rooms Card -->
                <div class="card small" wire:click="setAvailability('unavailable')" style="cursor:pointer;">
                    <div class="d-flex justify-content-between align-items-center" id="unavailable-icon" data-availability="0">
                        <div class="left-content">
                            <h5>Used</h5>
                            <p>{{ $unavailableRoomCount }} Rooms</p>
                        </div>
                        <div class="right-content-unavailable">
                            <i class="fas fa-couch" id="room-icon" data-availability="1"></i>
                        </div>
                    </div>
                </div>

                     <!-- Guest Card -->
                <a href="{{ route('admin.rooms.detail', ['date' => now()->format('Y-m-d'), 'typecheckin' => 'guest']) }}" style="cursor:pointer; text-decoration: none; color: inherit;">
                    <div class="card small" style="cursor:pointer;">
                        <div class="d-flex justify-content-between align-items-center" id="unavailable-icon" data-availability="0">
                            <div class="left-content">
                                <h5>Room Today's</h5>
                                <p>{{ $roomToday }} Rooms</p>
                            </div>
                            <div class="right-content-guest">
                                <i class="fa-solid fa-building" id="unavailable-icon" data-availability="0"></i>
                            </div>
                        </div>
                    </div>
              </a>

                <!-- All Room Card -->
                <div class="card small all-rooms" wire:click="setAvailability(null)" style="cursor:pointer;">
                    <div class="d-flex justify-content-between align-items-center" id="unavailable-icon" data-availability="0">
                        <div class="left-content">
                            <h5>All Rooms</h5>
                            <p>{{ $allRoomCount }}</p>
                        </div>
                        <div class="right-content-allroom">
                            <i class="fas fa-hotel" id="unavailable-icon" data-availability="0"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Spinner -->
    <div class="text-center my-4" wire:loading wire:target="setAvailability">
        <div class="spinner-border text-secondary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <strong style="margin-left:10px; font-size:18px;">Loading data, please wait...</strong>
    </div>

    <div class="card container-room mb-4" wire:poll.5s>
        @php
            $groupedRooms = $rooms->groupBy(function ($room) {
                return $room->category ? $room->category->name : 'Uncategorized';
            })->sortKeys();
        @endphp

        @foreach($groupedRooms as $categoryName => $categoryRooms)
            <h4 class="mb-4 mt-4">{{ $categoryName }}</h4>
            <div>
                @forelse($categoryRooms as $room)
                    @php
                        $nextBooking = $upcomingBookings[$room->roomId][0] ?? null;
                        $isBlinking = false;
                        if ($nextBooking) {
                            $timeIn = $nextBooking->TimeIn ? \Carbon\Carbon::parse($nextBooking->TimeIn) : null;
                            $now = now();
                            // Expired uncheck-in: IsCheckedIn == 0 dan sudah lewat 3 jam dari TimeIn
                            $isExpiredUncheckin = ($nextBooking->IsCheckedIn == 0) &&
                                $timeIn &&
                                $timeIn->copy()->addHours(3)->lt($now);

                            // BLINK: jika belum check-in, belum expired uncheck-in, dan sudah masuk 1 jam sebelum TimeIn
                            if (
                                ($nextBooking->IsCheckedIn == 0) &&
                                !$isExpiredUncheckin &&
                                $timeIn &&
                                $timeIn->diffInMinutes($now, false) >= -60
                            ) {
                                $isBlinking = true;
                            }
                        }
                    @endphp
                    <div class="room-card edit-room
                        @if(in_array($room->available, [1, 3, 5, 7])) available-room
                        @elseif($room->available == 2) unavailable-room
                        @elseif($room->available == 4) mntc-room
                        @elseif($room->available == 6) oo-room
                        @else unavailable-room @endif
                        @if($isBlinking) blinking-room @endif" data-id="{{ $room->id }}">

                        <div style="display: flex; flex-direction: column; align-items: flex-start;">
                            <div>
                                <i class="fas fa-couch room-icon"></i>
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
                @empty
                    <p>No rooms available based on the selected filters.</p>
                @endforelse
            </div>
        @endforeach

        <div class="legend" style="margin-top: 10%;">
            <div class="legend-card available-legend">
                <i class="fas fa-couch legend-icon"></i>
                <span class="legend-name">Available</span>
            </div>
            <div class="legend-card unavailable-legend">
                <i class="fas fa-couch legend-icon"></i>
                <span class="legend-name">Used</span>
            </div>
            <div class="legend-card mntc-legend">
                <i class="fas fa-couch legend-icon"></i>
                <span class="legend-name">Maintenance</span>
            </div>
            <div class="legend-card oo-legend">
                <i class="fas fa-couch legend-icon"></i>
                <span class="legend-name">OO</span>
            </div>
        </div>
    </div>
</div>