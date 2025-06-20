@extends('layouts.appAdmin')
@section('header_title', 'Dashboard')
@section('content')
    <style>
        .card {
            padding: 50px;
            border: none;
            box-shadow: rgb(230, 231, 235) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
        }

        .small {
            padding: 15px 20px;
            box-shadow: rgb(230, 231, 235) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
            margin-right: 35px;
            margin-bottom: 15px;
        }

        /* Styling for portrait cards */
        .portrait-card {
            height: 400px;
            box-shadow: rgb(230, 231, 235) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
            padding: 15px;
            text-align: center;
        }

        .left-content-booking-list,
        .left-content-room-used,
        .left-content-guest-todays,
        .left-content-booking-canceled,
        .left-content-totalgaji,
        .left-content-room-available {
            flex: 0 0 auto;
            display: flex;
            align-items: center;
        }

        .left-content-room-used i {
            padding: 10px;
            border-radius: 10%;
            font-size: 1.8rem;
            color: #FFAB00;
            background-color: #FFF1D6;
            margin-right: 50px;
            margin-top: 10px;
        }

        .left-content-booking-list i {
            padding: 10px 15px;
            border-radius: 10%;
            font-size: 1.8rem;
            color: #5837dd;
            background-color: #dfe4fa;
            margin-right: 50px;
            margin-top: 10px;
        }

        .left-content-guest-todays i {
            padding: 10px;
            border-radius: 10%;
            font-size: 1.8rem;
            color: #71DD37;
            background-color: #E8FADF;
            margin-right: 50px;
            margin-top: 10px;
        }

        .left-content-booking-canceled i {
            padding: 10px 15px;
            border-radius: 10%;
            font-size: 1.8rem;
            color: #FF3E1D;
            background-color: #FFE0DB;
            margin-right: 50px;
            margin-top: 10px;
        }

        .left-content-room-available i {
            padding: 10px;
            border-radius: 10%;
            font-size: 1.8rem;
            color: #00ff26;
            background-color: #e8ffdb;
            margin-right: 50px;
            margin-top: 10px;
        }


        .right-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex: 1;
        }

        .right-content h5 {
            font-size: 1.1rem;
            margin: 0;
            font-weight: bold;
            margin-right: 10px;
        }

        .right-content p {
            margin: 0;
            font-size: 1.5rem;
            color: #5c6bc0;
            margin-left: 25px;
            margin-top: -20px;
        }

        .potrait-list {
            overflow-y: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
            cursor: pointer;
            padding: 5px;
        }

        .potrait-list::-webkit-scrollbar {
            display: none;
        }

        .data-booking {
            padding: 10px 0px;
            margin-bottom: 5px;
            border-radius: 10px;
            background-color: rgba(92, 107, 192, 0.31);
        }

        .data-booking p {
            color: black;
            margin: 0;
            font-size: 0.9rem;
        }

        .data-guestCheckin {
            padding: 10px 0px;
            margin-bottom: 5px;
            border-radius: 10px;
            background-color: rgba(122, 192, 92, 0.31);
        }

        .data-guestCheckin p {
            color: black;
            margin: 0;
            font-size: 0.9rem;
        }

        .data-roomActive {
            padding: 10px 0px;
            margin-bottom: 5px;
            border-radius: 10px;
            background-color: rgba(248, 207, 82, 0.44);
        }

        .data-roomActive p {
            color: black;
            margin: 0;
            font-size: 0.9rem;
        }
    </style>

    <div class="row">
        <div class="col-md-8">
            <div class="card p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h1>Welcome to Admin Dashboard</h1>
                        <p>This is the main content area.</p>
                    </div>
                    <img src="{{ asset('img/fotoadmin.png') }}" alt="Image" class="img-fluid" style="max-width: 150px;" />
                </div>
            </div>
            <div class="card p-4 mt-4">
                <div class="d-flex flex-column" style="height: 340px;">
                    <canvas id="checkinChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.rooms') }}" style="cursor:pointer; text-decoration: none; color: inherit;">
                <div class="card small">
                    <div class="left-content-room-available">
                        <i class="fas fa-couch"></i>
                        <h5>Room Available</h5>
                    </div>
                    <div class="right-content" style="margin-left: 27%;">
                        <p>{{ $availableRoomCount }}</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.rooms') }}" style="cursor:pointer; text-decoration: none; color: inherit;">
                <div class="card small">
                    <div class="left-content-room-used">
                        <i class="fas fa-couch"></i>
                        <h5>Room Used</h5>
                    </div>
                    <div class="right-content" style="margin-left: 27%;">
                        <p>{{ $unavailableRoomCount }}</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.rooms.detail', ['date' => now()->format('Y-m-d'), 'typecheckin' => 'guest']) }}"
                style="cursor:pointer; text-decoration: none; color: inherit;">
                <div class="card small">
                    <div class="left-content-guest-todays" style="margin-right: 19px;">
                        <i class="fas fa-users"></i>
                        <h5>Today's Guest</h5>
                    </div>
                    <div class="right-content" style="margin-left: 27%;">
                        <p>{{ $guestToday }}</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.rooms.booking') }}" style="cursor:pointer; text-decoration: none; color: inherit;">
                <div class="card small">
                    <div class="left-content-booking-list">
                        <i class="fa-solid fa-list-check"></i>
                        <h5>Booking List</h5>
                    </div>
                    <div class="right-content" style="margin-left: 27%;">
                        <p>{{ $bookingList }}</p>
                    </div>
                </div>
            </a>

            <div class="card small">
                <div class="left-content-booking-canceled" style="margin-right: 19px;">
                    <i class="fa-solid fa-list-check"></i>
                    <h5>Booking Canceled</h5>
                </div>
                <div class="right-content" style="margin-left: 27%;">
                    <p>{{ $bookingCanceled }} this week</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Row for Portrait Cards -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card portrait-card">
                <h5>Today Guest</h5>
                <div class="potrait-list">
                    @forelse($guestCheckinData as $guest)
                        @php
                            $checkInTime = \Carbon\Carbon::parse($guest->CheckInTime);
                        @endphp
                        <div class="data-guestCheckin">
                            <p>
                                <strong style="font-size: large;">{{ $guest->RoomId }} : </strong>
                                {{ $guest->GuestName }}
                                Check-in at {{ $checkInTime->format('d M Y H:i') }}
                            </p>
                        </div>
                    @empty
                        <div class="data-guestCheckin">
                            <p>No CheckIn Guest.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card portrait-card">
                <h5>Booking List</h5>
                <div class="potrait-list">
                    @foreach($bookinglistData as $booking)
                        @php
                            // Gabungkan tanggal dan jam untuk TimeIn
                            $timeIn = \Carbon\Carbon::parse($booking->TimeIn);
                        @endphp
                        @if($timeIn->greaterThanOrEqualTo(now()))
                            <div class="data-booking">
                                <p>
                                    <strong style="font-size: large;">{{ $booking->RoomId }} : </strong>
                                    {{ $booking->GuestName }}
                                    at {{ $timeIn->format('d M Y H:i') }}
                                </p>
                            </div>
                        @endif
                    @endforeach

                    @if($bookinglistData->filter(fn($b) => \Carbon\Carbon::parse($b->TimeIn)->greaterThanOrEqualTo(now()))->isEmpty())
                        <div class="data-booking">
                            <p>No upcoming bookings.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card portrait-card" style="margin-right:35px;">
                <h5>Running Room's Now</h5>
                <div class="potrait-list">
                    @forelse($roomActiveData as $room)
                        @php
                            $checkInTime = \Carbon\Carbon::parse($room->CheckInTime);
                        @endphp
                        <div class="data-roomActive">
                            <p>
                                <strong style="font-size: large;">{{ $room->RoomId }} : </strong>
                                {{ $room->GuestName }}
                                Check-in at {{ $checkInTime->format('H:i') }}
                            </p>
                        </div>
                    @empty
                        <div class="data-roomActive">
                            <p>No CheckIn Guest.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @php
        $bulan = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'Mei',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Agu',
            9 => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des'
        ];
        $labels = [];
        $data = [];
        foreach (range(1, 12) as $m) {
            $labels[] = $bulan[$m];
            $data[] = $checkinReport[$m] ?? 0;
        }
    @endphp



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('checkinChart').getContext('2d');
        const checkinChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Report',
                    data: @json($data),
                    tension: 0.4,
                    borderColor: '#696CFF',
                    backgroundColor: 'rgba(105, 108, 255, 0.1)',
                    borderWidth: 3,
                    pointBackgroundColor: '#696CFF',
                    pointBorderColor: '#fff',
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            boxWidth: 12,
                            padding: 20,
                            font: {
                                size: 13
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#6B7280'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#6B7280',
                            callback: function (value) {
                                return value + (value === 1 ? ' Guest' : ' Guests');
                            }
                        }
                    }
                },
                elements: {
                    line: {
                        cubicInterpolationMode: 'monotone'
                    }
                }
            }
        });
    </script>
@endsection