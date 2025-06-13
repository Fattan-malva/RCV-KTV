@extends('layouts.appAdmin')
@section('header_title', 'Rooms-KTV')
@section('content')
    <style>
        .card {
            padding: 20px;
            border: none;
            box-shadow: rgb(230, 231, 235) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .small {
            padding: 15px 10px;
            box-shadow: rgb(230, 231, 235) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
            flex: 1 1 calc(25% - 15px);
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .small:hover {
            transform: translateY(-5px);
            box-shadow: rgb(230, 231, 235) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 6px 15px -3px;
        }

        .left-content {
            flex: 1;
            margin-right: 50px;
        }

        .left-content h5 {
            font-size: 1.2rem;
            margin: 0;
        }

        .left-content p {
            margin: 5px 0 0;
            font-size: 1rem;
            color: #5c6bc0;
        }

        .right-content-available i {
            color: #71DD37;
            background-color: #E8FADF;
            padding: 11px;
            border-radius: 10%;
            font-size: 2rem;
            margin-left: 10px;
        }

        .right-content-unavailable i {
            color: #975a00;
            background-color: #f8d9ab;
            padding: 11px;
            border-radius: 10%;
            font-size: 2rem;
            margin-left: 10px;
        }

        .right-content-guest i {
            color: #696CFF;
            background-color: #E7E7FF;
            padding: 11px;
            border-radius: 10%;
            font-size: 2rem;
            margin-left: -10px;
        }

        .right-content-allroom i {
            color: #FFAB00;
            background-color: #FFF1D6;
            padding: 7px 13px;
            border-radius: 10%;
            font-size: 2rem;
            margin-left: -10px;
        }



        .filter-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .filter {
            flex: 1 1 calc(25% - 20px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-width: 200px;
        }

        .filter select {
            width: 100%;
            max-width: 250px;
            padding: 8px;
            border-radius: 4px;
            border: none;
            outline: none;
            box-shadow: rgb(230, 231, 235) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
        }

        .filter select:focus {
            border: none;
            box-shadow: rgb(230, 231, 235) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
            box-shadow: none;
        }


        .setting {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #696cff;
            background-color: transparent;
        }

        .setting i {
            transition: all 0.3s ease;
        }

        .setting i:hover {
            transform: translateY(-2px);
        }

        .container-room {
            min-height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .room-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            width: 140px;         /* Static width */
            height: 85px;        /* Static height */
            padding: 10px;
            margin: 5px;
            border: 4px solid #ddd;
            box-shadow: rgb(230, 231, 235) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
            border-radius: 8px;
            text-align: left;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .room-name {
            font-size: 20px;
            font-weight: bold;
        }


        .room-card:active {
            transform: translateY(5px);
            box-shadow: none;
        }

        .available-room {
            background-color: #E8FADF;
            color: #71DD37;
            border-color: #E8FADF;
        }

        .unavailable-room {
            background-color: #f8d9ab;   
            border-color: #f9deb6;      
            color: #975a00;             
        }

        .mntc-room {
            background-color: #bdbdbd;
            color: #222;
            border-color: #bdbdbd;
        }
        .oo-room {
            background-color: #030303;
            color: #ffffff; 
            border-color: #030303;
        }

        .room-icon {
            font-size: 24px;
            margin-right: 10px;
        }

        .unavailable-room .room-icon {
            color: #975a00;
        }

        .card .room-card {
            margin-bottom: 10px;
        }

        .legend {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .legend-card {
            display: inline-flex;
            /* Ganti dengan inline-flex agar menyesuaikan panjang konten */
            align-items: center;
            justify-content: flex-start;
            padding: 10px;
            margin: 10px;
            border: 2px solid #ddd;
            box-shadow: rgb(230, 231, 235) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            white-space: nowrap;
            /* Menjaga teks tidak terpotong */
        }

        .legend-name {
            font-size: 16px;
            font-weight: bold;
        }
        .available-legend {
            background-color: #E8FADF;
            color: #71DD37;
            border-color: #E8FADF;
        }

        .unavailable-legend {
            background-color: #f8d9ab;   
            border-color: #f9deb6;      
            color: #975a00; 
        }

        .mntc-legend {
            background-color: #bdbdbd;
            color: #222;
            border-color: #bdbdbd;
        }
        .oo-legend {
            background-color: #030303;
            color: #ffffff; 
            border-color: #030303;
        }

        .legend-icon {
            font-size: 24px;
            margin-right: 10px;
        }

        .legend-card:active {
            transform: translateY(5px);
            box-shadow: none;
        }

        .content.collapsed .card>div {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: flex-start;
            transition: gap 0.3s ease;
        }

        .card>div {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: flex-start;
            transition: gap 0.3s ease;
        }

        .offcanvas-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        #roomTab,
        #categoryTab {
            font-size: 1.25rem;
            font-weight: bold;
            background: none;
            border: none;
            color: #000;
            padding: 5;
            cursor: pointer;
        }

        #roomTab:hover,
        #categoryTab:hover {
            background-color: rgb(235, 236, 236);
            color: #696cff;
            border-radius: 5px;

        }

        #roomTab:focus,
        #categoryTab:focus {
            background-color: #696cff;
            color: white;
            border-color: #696cff;
            border-radius: 5px;
        }


        .portrait-card {
            display: none;
            height: 400px;
            box-shadow: rgb(230, 231, 235) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
            padding: 15px;
            text-align: center;
        }

        #updateRoomModalLabel {
            display: flex;
            justify-content: center;
            width: 100%;
            font-size: 1.5rem;
        }
        .btn-mntc {
            background-color: transparent !important; 
            color: #333 !important;
            border-color: #bdbdbd !important;
            transition: background 0.2s;
        }
        .btn-mntc.active {
            background-color: #bdbdbd !important; 
            color: #222 !important;
            border-color: #9e9e9e !important;
        }
        #roomStatusButtons .status-btn {
            margin-right: 8px;
            margin-bottom: 8px;
            width: 100%;
            padding: 20px 40px;
            white-space: nowrap; 
            border-width: 3px !important;
        }
        select.form-select:disabled {
            background-color: #fff !important;   
            color: #212529 !important;           
            opacity: 1 !important;               
            cursor: not-allowed;                 
            border-color: #ced4da;              
        }

        select.form-select option {
            font-size: 18px;
        }

        @media (max-width: 768px) {
            .room-card {
                width: 150px;
            }
        }

        .blinking-room {
            animation: colorful-blink 1.5s linear infinite;
            color: black; /* Optional: agar teks kontras */
            padding: 10px;
            border-radius: 15px;
        }

        @keyframes colorful-blink {
            0%   { background-color: #c10000; opacity: 1; }
            25%  { background-color: #ff8000; opacity: 0.7; }
            50%  { background-color: #ffff01; opacity: 0.3; }
            75%  { background-color: #00ad00; opacity: 0.7; }
            100% { background-color: #00bfff; opacity: 1; }
        }

    </style>

    <div class="container-content" style="margin-right: 25px;">
        <!-- Row for Small Cards -->
        <div class="row">
            <div class="col-12 mb-3">
                <div class="card-container">
                    <!-- Available Rooms Card -->
                    <div class="card small">
                        <div class="d-flex justify-content-between align-items-center" id="available-icon"
                            data-availability="1">
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
                    <div class="card small">
                        <div class="d-flex justify-content-between align-items-center" id="unavailable-icon"
                            data-availability="0">
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
                    <div class="card small" id="reset-button">
                        <div class="d-flex justify-content-between align-items-center" id="unavailable-icon"
                            data-availability="0">
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

        <!-- Filter Room -->
        <!-- <h5>Search Filter</h5> -->
        <form method="GET" action="{{ route('admin.rooms') }}" id="filter-form">
            <div class="row" style="display: none;">
                <div class="col-8">
                    <div class="filter-container mb-3">
                        <div class="filter">
                            <select name="category" id="room-category" class="form-select auto-submit">
                                <option value="">All Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="filter">
                            <select name="availability" id="room-availability" class="form-select auto-submit">
                                <option value="">All Availability</option>
                                <option value="available" {{ request('availability') == 'available' ? 'selected' : '' }}>
                                    Available</option>
                                <option value="unavailable" {{ request('availability') == 'unavailable' ? 'selected' : '' }}>
                                    Unavailable</option>
                            </select>
                        </div>
                        <div class="filter">
                            <select name="capacity" id="room-capacity" class="form-select auto-submit">
                                <option value="">All Capacity</option>
                                <option value="1" {{ request('capacity') == '1' ? 'selected' : '' }}>1 Guest</option>
                                <option value="2" {{ request('capacity') == '2' ? 'selected' : '' }}>2 Guests</option>
                                <option value="3" {{ request('capacity') == '3' ? 'selected' : '' }}>3 Guests</option>
                                <option value="4" {{ request('capacity') == '4' ? 'selected' : '' }}>4 Guests</option>
                            </select>
                        </div>
                        <div class="setting">
                            <i class="fa-solid fa-arrows-rotate fa-xl" id="reset-button"></i>
                        </div>
                        <div class="setting" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCreateRoom"
                            aria-controls="offcanvasCreateRoom" onclick="activateRoomTab()">
                            <i class="fa-solid fa-gear fa-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Offcanvas for Creating Room -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCreateRoom"
            aria-labelledby="offcanvasCreateRoomLabel">
            <div class="offcanvas-header d-flex justify-content-between w-100">
                <!-- Room Button -->
                <button id="roomTab" type="button" onclick="showRoomForm()">Room</button>
                <!-- Category Button -->
                <button id="categoryTab" type="button" onclick="showCategoryForm()">Categories</button>
            </div>

            <div class="offcanvas-body">
                <!-- Room Form -->
                <div id="roomForm">
                    <form action="{{ route('admin.rooms-store') }}" method="POST">
                        @csrf
                        <!-- RoomId Input -->
                        <div class="mui-input-container">
                            <input type="text" id="roomId" name="roomId" class="@error('roomId') is-invalid @enderror"
                                placeholder=" " value="{{ old('roomId') }}" required />
                            <label for="roomId">Room ID</label>
                            @error('roomId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Room Name Input -->
                        <div class="mui-input-container">
                            <input type="text" id="name" name="name" class="@error('name') is-invalid @enderror"
                                placeholder=" " value="{{ old('name') }}" required />
                            <label for="name">Room Number</label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Category Select -->
                        <div class="mui-input-container">
                            <select class="mui-select @error('room_category_id') is-invalid @enderror" id="room_category_id"
                                name="room_category_id" required>
                                <option value="" disabled selected>Choose Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('room_category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="room_category_id" class="form-label">Category</label>
                            @error('room_category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Availability Select -->
                        <div class="mui-input-container">
                            <select class="mui-select @error('capacity') is-invalid @enderror" id="capacity" name="capacity"
                                required>
                                <option value="" disabled selected>Choose Capacity</option>
                                <option value="1" {{ old('capacity') == '1' ? 'selected' : '' }}>1 Guest</option>
                                <option value="2" {{ old('capacity') == '2' ? 'selected' : '' }}>2 Guests</option>
                                <option value="3" {{ old('capacity') == '3' ? 'selected' : '' }}>3 Guests</option>
                                <option value="4" {{ old('capacity') == '4' ? 'selected' : '' }}>4 Guests</option>
                            </select>
                            <label for="capacity" class="form-label">Capacity</label>
                            @error('capacity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="submit" name="create_another" value="1" class="btn btn-secondary">Create &
                                Another</button>
                            <button type="button" class="btn btn-danger btn-label-danger" data-bs-dismiss="offcanvas"
                                aria-label="Close">Cancel</button>
                        </div>
                    </form>
                </div>

                <!-- Category Form (Initially Hidden) -->
                <div id="categoryForm" style="display: none;">
                    <form action="{{ route('admin.categories-store') }}" method="POST">
                        @csrf
                        <!-- Category Name Input -->
                        <div class="mui-input-container">
                            <input type="text" id="name" name="name" class="@error('name') is-invalid @enderror"
                                placeholder=" " value="{{ old('name') }}" required />
                            <label for="name">Categories Name</label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description Input -->
                        <div class="mui-input-container">
                            <input type="text" id="description" name="description"
                                class="@error('description') is-invalid @enderror" placeholder=" "
                                value="{{ old('description') }}" required />
                            <label for="description">Description</label>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="submit" name="create_another" value="1" class="btn btn-secondary">Create &
                                Another</button>
                            <button type="button" class="btn btn-danger btn-label-danger" data-bs-dismiss="offcanvas"
                                aria-label="Close">Cancel</button>
                        </div>
                    </form>

                    <!-- Display Existing Categories Below the Buttons -->
                    <div class="mt-4">
                        <h5>Existing Categories</h5>
                        @if($categories->isEmpty())
                            <p>No categories found.</p>
                        @else
                            <ul class="list-group">
                                @foreach($categories as $category)
                                    <li class="list-group-item">
                                        <strong>- {{ $category->name }}</strong>
                                        <!-- Delete Button with Icon -->
                                        <form action="{{ route('admin.categories-destroy', $category->id) }}" method="POST"
                                            class="d-inline-block float-end">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                </div>

            </div>
        </div>

        <!-- Room Card -->
   
           @livewire('room-realtime')

        <!-- Modal Update -->
        <div class="modal fade" id="updateRoomModal" tabindex="-1" aria-labelledby="updateRoomModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="updateRoomForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateRoomModalLabel">Room</h5>
                        </div>
                        <div class="modal-body">
                           
                            <div class="row">
                                 <div id="roomBookingList" class="mb-3"></div>
                                 <input type="hidden" id="roomName" name="name" required>
                                <div class="mb-3 col-md-6">
                                    <label for="guestName" class="form-label">Guest Name</label>
                                    <input type="text" id="guestName" name="guest_name" class="form-control" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="notes" class="form-label">Notes</label>
                                    <textarea id="notes" name="notes" class="form-control"></textarea>
                                </div>
                                <!-- <div class="mb-3 col-md-6">
                                    <label for="tablet_number" class="form-label">No. Tablet</label>
                                    <textarea id="tablet_number" name="tablet_number" class="form-control"></textarea>
                                </div> -->
                                <div class="mb-3 col-md-6">
                                    <label for="roomCategory" class="form-label">Category</label>
                                    <select id="roomCategory" name="room_category_id" class="form-select" required disabled>
                                        <!-- Options akan diisi melalui JavaScript -->
                                    </select>
                                    <input type="hidden" id="roomCategoryHidden" name="room_category_id">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="roomCapacity" class="form-label">Capacity</label>
                                    <input type="number" id="roomCapacity" name="capacity" class="form-control" required readonly>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Status</label>
                                    <div id="roomStatusButtons" class="d-flex gap-2"></div>
                                    <input type="hidden" id="roomAvailable" name="available" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Row for Portrait Cards -->
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card portrait-card">
                    <h5>Portrait 1</h5>
                    <p>Content for portrait 1.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card portrait-card">
                    <h5>Portrait 2</h5>
                    <p>Content for portrait 2.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card portrait-card">
                    <h5>Portrait 3</h5>
                    <p>Content for portrait 3.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- JS Offcanvas -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
    <script>
        let bookingHtml = '';
        if (data.bookings && data.bookings.length > 0) {
            bookingHtml += '<div class="alert alert-info p-2 mb-2"><strong>Upcoming Booking List:</strong><ul style="margin-bottom:0">';
            data.bookings.forEach(function(booking) {
                bookingHtml += `<li><b>${booking.GuestName}</b> at <span style="color:#696cff">${booking.TimeIn ? moment(booking.TimeIn).format('DD MMM YYYY HH:mm') : '-'}</span></li>`;
            });
            bookingHtml += '</ul></div>';
        } else {
            bookingHtml += '<div class="alert alert-secondary p-2 mb-2">No upcoming bookings for this room.</div>';
        }
        $('#roomBookingList').html(bookingHtml);
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get the elements
            const roomForm = document.getElementById('roomForm');
            const categoryForm = document.getElementById('categoryForm');
            const roomTab = document.getElementById('roomTab');
            const categoryTab = document.getElementById('categoryTab');
            const offcanvasElement = document.getElementById('offcanvasCreateRoom');

            // Function to activate Room Tab
            function activateRoomTab() {
                roomTab.classList.add('active'); // Activate Room Tab
                categoryTab.classList.remove('active'); // Deactivate Category Tab
                roomForm.style.display = 'block'; // Show Room Form
                categoryForm.style.display = 'none'; // Hide Category Form
                roomTab.focus(); // Focus on Room Tab
            }

            // Event listener to show Room Form when Room Tab is clicked
            roomTab.addEventListener('click', function () {
                activateRoomTab();
            });

            // Show Category Form when Category Tab is clicked
            categoryTab.addEventListener('click', function () {
                categoryTab.classList.add('active'); // Activate Category Tab
                roomTab.classList.remove('active'); // Deactivate Room Tab
                roomForm.style.display = 'none'; // Hide Room Form
                categoryForm.style.display = 'block'; // Show Category Form
                categoryTab.focus(); // Focus on Category Tab
            });

            // Ensure Room Tab is active when offcanvas is opened
            offcanvasElement.addEventListener('shown.bs.offcanvas', function () {
                activateRoomTab();
            });

            // Handle validation errors and success messages
            @if ($errors->any())
                var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                offcanvas.show(); // Show offcanvas on error
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error!',
                    text: '{{ $errors->first() }}',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                // Ensure Category Tab is selected if there are validation errors
                categoryTab.classList.add('active'); // Activate Category Tab
                roomTab.classList.remove('active'); // Deactivate Room Tab
                roomForm.style.display = 'none'; // Hide Room Form
                categoryForm.style.display = 'block'; // Show Category Form
            @endif

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 3000
                });

                if ("{{ session('create_another') }}") {
                    // Ensure offcanvas remains open if 'create_another' is set
                    var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                    offcanvas.show();
                    // Ensure Category Tab is shown if creating another category
                    categoryTab.classList.add('active');
                    roomTab.classList.remove('active');
                    roomForm.style.display = 'none';
                    categoryForm.style.display = 'block';
                } else {
                    var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                    offcanvas.hide();
                }
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Deletion Failed!',
                    text: '{{ session('error') }}',
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 3000
                });

                // Keep offcanvas open when there is a deletion failure
                var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                offcanvas.show();
                // Ensure Category Tab remains active when deletion fails
                categoryTab.classList.add('active');
                roomTab.classList.remove('active');
                roomForm.style.display = 'none';
                categoryForm.style.display = 'block';
            @endif
        });
    </script>

    <!-- JS Filter -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const autoSubmitElements = document.querySelectorAll('.auto-submit');
            autoSubmitElements.forEach(function (element) {
                element.addEventListener('change', function () {
                    document.getElementById('filter-form').submit();
                });
            });
        });
        document.getElementById('reset-button').addEventListener('click', function () {
            document.querySelectorAll('#filter-form select').forEach(function (select) {
                select.value = '';
            });
            document.getElementById('filter-form').submit();
        });
        document.addEventListener('DOMContentLoaded', function () {
            const availableIcon = document.getElementById('available-icon');
            const unavailableIcon = document.getElementById('unavailable-icon');

            if (availableIcon) {
                availableIcon.addEventListener('click', function () {
                    // Set filter ke "available"
                    document.getElementById('room-availability').value = 'available';
                    document.getElementById('filter-form').submit();
                });
            }

            if (unavailableIcon) {
                unavailableIcon.addEventListener('click', function () {
                    // Set filter ke "unavailable"
                    document.getElementById('room-availability').value = 'unavailable';
                    document.getElementById('filter-form').submit();
                });
            }
        });
    </script>
    <!-- JS Room Modal Update -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Event listener untuk tombol edit room
            $('.edit-room').on('click', function () {
                const roomId = $(this).data('id');
                const url = `/rooms/${roomId}/edit`;

                $.get(url, function (data) {
                    // Render Booking List
                    let bookingHtml = '';
                    if (data.bookings && data.bookings.length > 0) {
                        bookingHtml += '<div class="alert alert-info p-2 mb-2"><strong>Upcoming Booking List:</strong><ul style="margin-bottom:0">';
                        data.bookings.forEach(function(booking) {
                            bookingHtml += `<li><b>${booking.GuestName}</b> at <span style="color:#696cff">${booking.TimeIn ? moment(booking.TimeIn).format('DD MMM YYYY HH:mm') : '-'}</span></li>`;
                        });
                        bookingHtml += '</ul></div>';
                    } else {
                        bookingHtml += '<div class="alert alert-secondary p-2 mb-2">No upcoming bookings for this room.</div>';
                    }
                    $('#roomBookingList').html(bookingHtml);

                    // Isi modal form seperti biasa
                    $('#updateRoomModalLabel').text(`Room : ${data.room.name}`);
                    $('#updateRoomModal #roomName').val(data.room.name);
                    $('#updateRoomModal #guestName').val(data.trx ? data.trx.GuestName : '');
                    $('#updateRoomModal #notes').val(data.trx ? data.trx.Notes : '');
                    $('#updateRoomModal #tablet_number').val(data.trx ? data.room.tablet_number : '');
                    $('#updateRoomModal #roomCategory').html('');
                    data.categories.forEach(category => {
                        $('#updateRoomModal #roomCategory').append(`
                <option value="${category.id}" ${data.room.room_category_id == category.id ? 'selected' : ''}>
                    ${category.name}
                </option>
            `);
                    });
                    $('#updateRoomModal #roomCapacity').val(data.room.capacity);
                    $('#updateRoomModal #roomCategoryHidden').val(data.room.room_category_id);

                    // Status Button Logic
                    const status = parseInt(data.room.available);
                    const statusButtons = [];
                    if ([1, 3, 5, 7].includes(status)) {
                        statusButtons.push({ val: 2, label: 'Guest Check-in', color: 'success' });
                        statusButtons.push({ val: 4, label: 'MNTC Check-in', color: 'secondary', customClass: 'btn-mntc' });
                        statusButtons.push({ val: 6, label: 'OO Check-in', color: 'dark', textWhite: true });
                    } else if (status === 2) {
                        statusButtons.push({ val: 3, label: 'Guest Check-out', color: 'danger' });
                    } else if (status === 4) {
                        statusButtons.push({ val: 5, label: 'MNTC Check-out', color: 'danger' });
                    } else if (status === 6) {
                        statusButtons.push({ val: 7, label: 'OO Check-out', color: 'danger' });
                    }

                    const $btnGroup = $('#roomStatusButtons');
                    $btnGroup.empty();
                    statusButtons.forEach(btn => {
                        $btnGroup.append(`
                <button type="button" class="btn btn-outline-${btn.color} status-btn ${btn.customClass || ''}" data-value="${btn.val}">
                    <strong>${btn.label}</strong>
                </button>
            `);
                    });

                    $('#updateRoomModal #roomAvailable').val(status);
                    $('.status-btn').off('click').on('click', function () {
                        $('.status-btn').removeClass('active');
                        $(this).addClass('active');
                        $('#updateRoomModal #roomAvailable').val($(this).data('value'));
                    });
                    $(`.status-btn[data-value="${status}"]`).addClass('active');

                    $('#updateRoomForm').attr('action', `/rooms/${roomId}`);
                    $('#updateRoomModal').modal('show');
                });
            });

           // Event listener untuk form submit
            $('#updateRoomForm').on('submit', function (e) {
                e.preventDefault();

                const form = $(this);
                const actionUrl = form.attr('action');
                const formData = form.serialize();

                // Ambil nilai status
                const status = parseInt($('#updateRoomModal #roomAvailable').val());

                // Validasi: jika tidak ada tombol status yang diklik (tidak ada .status-btn.active)
                if ($('#updateRoomModal .status-btn.active').length === 0) {
                    Swal.fire({
                        toast: true,
                        icon: 'error',
                        title: false,
                        html: 'Please select Check-in / Check-out status first!',
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    return; // Stop form submission
                }

                const submitButton = form.find('button[type="submit"]');
                submitButton.prop('disabled', true);

                $.ajax({
                    url: actionUrl,
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        if (response.success) {
                            sessionStorage.setItem('toastMessage', response.message);
                            location.reload();
                        }
                    },
                    error: function (xhr) {
                        const errors = xhr.responseJSON.errors || {};
                        let errorMessage = '';

                        if (xhr.status === 422) {
                            for (const field in errors) {
                                errorMessage += `${errors[field][0]}<br>`;
                            }

                            Swal.fire({
                                toast: true,
                                icon: 'error',
                                title: false,
                                html: errorMessage,
                                position: 'top',
                                showConfirmButton: false,
                                timer: 5000,
                            });
                        } else {
                            Swal.fire({
                                toast: true,
                                icon: 'error',
                                title: 'Error',
                                text: 'An unexpected error occurred.',
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 5000,
                            });
                        }
                    },
                    complete: function () {
                        submitButton.prop('disabled', false);
                    }
                });
            });


            // Menampilkan toast jika ada pesan di sessionStorage setelah halaman di-reload
            const toastMessage = sessionStorage.getItem('toastMessage');
            if (toastMessage) {
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    title: toastMessage,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 1000, // Duration of the toast in milliseconds
                }).then(() => {
                    // Hapus pesan dari sessionStorage setelah menampilkannya
                    sessionStorage.removeItem('toastMessage');
                });
            }
        });
    </script>

@endsection