@extends('layouts.appAdmin')
@section('header_title', 'Room Transactions')
@section('content')
    <div class="container">
        <div class="card p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h1>Booking List</h1>
                    <p>Manage Booking List, check-in/out, and guest information.</p>
                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasCreateTrxRoomDetail" aria-controls="offcanvasCreateTrxRoomDetail">
                        <i class="fa-solid fa-plus"></i> Add New Booking List
                    </button>
                </div>
                <div class="d-flex align-items-center">
                    <img src="{{ asset('img/karaokeroom.png') }}" alt="Image" class="img-fluid"
                        style="max-width: 120px; margin-bottom:8px; margin-right:50px;" />
                </div>
            </div>
        </div>
        <div class="card p-4 mt-4">
            <div>
                <table id="trxRoomTable" class="table table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Trx Date</th>
                            <th>Booking At</th>
                            <th>Room</th>
                            <th>Guest</th>
                            <th>Notes</th>
                            <th>BookPack</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookinglist as $index => $booking)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->TrxDate)->format('d M Y') }}</td>
                                <td>{{ $booking->TimeIn ? \Carbon\Carbon::parse($booking->TimeIn)->format('d M Y H:i') : '-' }}
                                </td>
                                <td>{{ $booking->RoomId }}</td>
                                <td>
                                    <div>
                                        <strong>{{ $booking->GuestName }}</strong>
                                    </div>
                                </td>
                                <td>{{ $booking->Notes ?? '-' }}</td>
                                <td>{{ $booking->BookPack ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCreateTrxRoomDetail"
        aria-labelledby="offcanvasCreateTrxRoomDetailLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasCreateTrxRoomDetailLabel">Add New Booking List</h5>
        </div>
        <div class="offcanvas-body">
            <form action="{{ route('admin.trx-room-booking.store') }}" method="POST">
                @csrf
                <div class="mui-input-container">
                    <input type="time" name="TimeIn" class="@error('TimeIn') is-invalid @enderror" required>
                    <label>Check In Time</label>
                    @error('TimeIn')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mui-input-container">
                    <input type="text" name="RoomId" class="@error('RoomId') is-invalid @enderror" required>
                    <label>Room ID</label>
                    @error('RoomId')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mui-input-container">
                    <input type="text" name="GuesName" class="@error('GuesName') is-invalid @enderror" required>
                    <label>Guest Name</label>
                    @error('GuesName')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mui-input-container">
                    <input type="text" name="BookPack" class="@error('BookPack') is-invalid @enderror">
                    <label>Booking Package</label>
                    @error('BookPack')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mui-input-container">
                    <textarea name="Notes" class="@error('Notes') is-invalid @enderror"></textarea>
                    <label>Notes</label>
                    @error('Notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-danger btn-label-danger" data-bs-dismiss="offcanvas"
                        aria-label="Close">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDeleteTrx(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This transaction will be deleted!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#B82020',
                cancelButtonColor: '#a6a4a4',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/admin/trx-room-detail/${id}`)
                        .then(response => {
                            window.location.reload();
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'The transaction has been deleted.',
                                toast: true,
                                position: 'top',
                                showConfirmButton: false,
                                timer: 5000,
                                timerProgressBar: true,
                            });
                        })
                        .catch(error => {
                            Swal.fire('Error!', 'Something went wrong!', 'error');
                        });
                }
            });
        }
        $(document).ready(function () {
            $('#trxRoomTable').DataTable({
                responsive: true,
                paging: true,
                searching: true,
                lengthChange: true,
                autoWidth: false,
                pageLength: 10,
                pagingType: "simple_numbers",
                language: {
                    paginate: {
                        next: "<i class='bx bx-chevron-right'></i> ",
                        previous: "<i class='bx bx-chevron-left'></i> "
                    },
                    lengthMenu: "_MENU_",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    search: "",
                }
            });
            $('#trxRoomTable_filter input').attr('placeholder', 'Search...').css('padding-left', '25px');
            $('#trxRoomTable_filter input').before('<i class="fas fa-search" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%);"></i>');
        });
    </script>
    <style>
        /* Copy style dari user management agar konsisten */
        .card {
            padding: 20px;
            border: none;
            box-shadow: rgb(230, 231, 235) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
        }


        #offcanvasCreateTrxRoomDetailLabel {
            padding: 1rem 1rem;
            margin-bottom: 0;
            border-radius: 20px;
            color: #696CFF;
            background-color: rgb(235, 236, 236);
        }

        #trxRoomTable_filter {
            margin-bottom: 15px;
            margin-left: 42%;
            position: relative;
        }

        #trxRoomTable_filter input {
            padding-left: 50px;
            border-radius: 20px;
        }

        #trxRoomTable_filter i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #384551;
        }

        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_info {
            color: #5a56e0;
        }

        .active>.page-link,
        .page-link.active {
            background-color: #696CFF !important;
            border-radius: 7px !important;
            border: none !important;
            color: white !important;
            box-shadow: none !important;
        }

        .page-link,
        .page-link.active {
            background-color: #F2F3F4 !important;
            border-radius: 7px !important;
            border: none !important;
            color: #384551 !important;
            transition: background-color 0.3s, color 0.3s;
        }

        .page-link:hover {
            background-color: rgb(213, 214, 214) !important;
            color: #696CFF !important;
        }

        .page-link:focus {
            outline: none !important;
            box-shadow: none !important;
        }

        .dataTables_wrapper .dataTables_paginate {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            margin: 0 5px;
        }

        table.dataTable tbody tr:nth-child(odd) {
            background-color: #fff;
        }

        table.dataTable tbody tr:nth-child(even) {
            background-color: #fff;
        }

        #trxRoomTable td,
        #trxRoomTable th {
            width: auto;
            text-align: center;
            vertical-align: middle;
            padding: 10px;
            border-left: none;
            border-right: none;
            border-bottom: 1px solid #ddd;
            border-top: 1px solid #ddd;
        }

        #trxRoomTable tr:last-child td {
            border-bottom: none;
        }

        .btn-action {
            transition: transform 0.3s ease;
            color: #646E78;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            color: #646E78;
        }

        .dropdown-menu {
            left: auto;
            right: 0;
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 10px 10px;
        }

        .dropdown-menu a {
            color: #384551;
        }

        .dropdown-menu a:hover {
            color: #696CFF;
            background-color: rgb(235, 236, 236);
            border-radius: 5px;
        }

        @media (max-width: 768px) {
            .table-responsive {
                -webkit-overflow-scrolling: touch;
                overflow-x: auto;
                display: block;
            }
        }
    </style>
@endsection