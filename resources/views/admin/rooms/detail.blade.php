@extends('layouts.appAdmin')
@section('title', 'Transaction List')
@section('header_title', 'Room Transactions')
@section('content')
    <div class="container-content" style="margin-right: 25px;">
        <div class="card p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h1>Transaction List</h1>
                    <p>Manage room transaction details, check-in/out, and guest information.</p>
                    <!-- <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                                                    data-bs-target="#offcanvasCreateTrxRoomDetail" aria-controls="offcanvasCreateTrxRoomDetail">
                                                    <i class="fa-solid fa-plus"></i> Add New Transaction
                                                </button> -->
                </div>
                <div class="d-flex align-items-center">
                    <img src="{{ asset('img/karaokeroom.png') }}" alt="Image" class="img-fluid"
                        style="max-width: 120px; margin-bottom:8px; margin-right:50px;" />
                </div>
            </div>
        </div>
        <div class="card p-4 mt-4">
            <!-- Tombol Print PDF -->
            <div class="button-print">
                <button class="btn mb-3" data-bs-toggle="modal" data-bs-target="#printModal"
                    style="background-color: #ae2f2f; color: white;">
                    <i class="fa fa-print"></i> Print PDF
                </button>
            </div>


            <!-- Modal Pilihan Metode Cetak -->
            <div class="modal fade" id="printModal" tabindex="-1" aria-labelledby="printModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('admin.detail.print-detail') }}" method="GET" target="_blank" id="printForm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="printModalLabel">Print Transaction Report</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Opsi Cetak Berdasarkan Rentang -->
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="mode" value="range" id="modeRange"
                                        checked>
                                    <label class="form-check-label" for="modeRange">
                                        Filter by Date Range
                                    </label>
                                </div>
                                <div id="rangeInputs" class="mb-3">
                                    <label>Start Date</label>
                                    <input type="date" name="start_date" class="form-control mb-2">
                                    <label>End Date</label>
                                    <input type="date" name="end_date" class="form-control">
                                </div>

                                <!-- Opsi Cetak Berdasarkan Bulan -->
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="mode" value="monthly"
                                        id="modeMonthly">
                                    <label class="form-check-label" for="modeMonthly">
                                        Filter by Month and Year
                                    </label>
                                </div>
                                <div id="monthlyInputs" class="mb-3" style="display: none;">
                                    <label>Month</label>
                                    <select name="month" class="form-control mb-2">
                                        @for ($m = 1; $m <= 12; $m++)
                                            <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                            </option>
                                        @endfor
                                    </select>
                                    <label>Year</label>
                                    <input type="number" name="year" class="form-control" placeholder="Example: 2025">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Preview</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div>
                <table id="trxRoomTable" class="table table-responsive ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Room</th>
                            <th>Guest</th>
                            <th>RCP With</th>
                            <th>Notes</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trxRoomDetails as $index => $trx)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($trx->TrxDate)->format('d M Y') }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($trx->CheckInTime)->format('d M Y H:i') }}
                                </td>
                                <td>
                                    @if($trx->CheckOutTime)
                                        {{ \Carbon\Carbon::parse($trx->CheckOutTime)->format('d M Y H:i') }}
                                    @endif
                                </td>
                                <td>{{ $trx->RoomId }}</td>
                                <td>
                                    <div>
                                        <strong>{{ $trx->GuestName }}</strong>
                                    </div>
                                </td>
                                <td>{{ $trx->ReservationWith }}</td>
                                <td>{{ $trx->Notes ?? '-' }}</td>
                                <td>
                                    @if(in_array($trx->TypeCheckIn, [2, 3]))
                                        Guest
                                    @elseif(in_array($trx->TypeCheckIn, [4, 5]))
                                        Maintenance
                                    @elseif(in_array($trx->TypeCheckIn, [6, 7]))
                                        OO
                                    @else
                                        -
                                    @endif
                                </td>
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
            <h5 id="offcanvasCreateTrxRoomDetailLabel">Add New Room Transaction</h5>
        </div>
        <div class="offcanvas-body">
            <form action="{{ route('admin.trx-room-detail.store') }}" method="POST">
                @csrf
                <div class="mui-input-container">
                    <input type="date" name="TrxDate" class="@error('TrxDate') is-invalid @enderror" required>
                    <label>Transaction Date</label>
                    @error('TrxDate')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mui-input-container">
                    <input type="time" name="CheckInTime" class="@error('CheckInTime') is-invalid @enderror" required>
                    <label>Check In Time</label>
                    @error('CheckInTime')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mui-input-container">
                    <input type="time" name="CheckOutTime" class="@error('CheckOutTime') is-invalid @enderror">
                    <label>Check Out Time</label>
                    @error('CheckOutTime')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mui-input-container">
                    <input type="text" name="TrxId" class="@error('TrxId') is-invalid @enderror" required>
                    <label>Transaction ID</label>
                    @error('TrxId')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mui-input-container">
                    <input type="text" name="RoomId" class="@error('RoomId') is-invalid @enderror" required>
                    <label>Room ID</label>
                    @error('RoomId')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mui-input-container">
                    <input type="text" name="GuestId" class="@error('GuestId') is-invalid @enderror">
                    <label>Guest ID</label>
                    @error('GuestId')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mui-input-container">
                    <input type="text" name="GuestName" class="@error('GuestName') is-invalid @enderror" required>
                    <label>Guest Name</label>
                    @error('GuestName')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
        document.addEventListener('DOMContentLoaded', function () {
            const modeRadios = document.querySelectorAll('input[name="mode"]');
            const rangeInputs = document.getElementById('rangeInputs');
            const monthlyInputs = document.getElementById('monthlyInputs');
            const printForm = document.getElementById('printForm');

            function toggleInputVisibility() {
                const selectedMode = document.querySelector('input[name="mode"]:checked').value;
                if (selectedMode === 'range') {
                    rangeInputs.style.display = 'block';
                    monthlyInputs.style.display = 'none';
                } else {
                    rangeInputs.style.display = 'none';
                    monthlyInputs.style.display = 'block';
                }
            }

            modeRadios.forEach(radio => {
                radio.addEventListener('change', toggleInputVisibility);
            });

            // Validasi manual saat form disubmit
            printForm.addEventListener('submit', function (e) {
                const selectedMode = document.querySelector('input[name="mode"]:checked').value;

                if (selectedMode === 'range') {
                    const start = printForm.querySelector('[name="start_date"]').value;
                    const end = printForm.querySelector('[name="end_date"]').value;

                    if (!start || !end) {
                        e.preventDefault();
                        alert("Mohon isi Tanggal Mulai dan Tanggal Akhir.");
                        return;
                    }
                } else if (selectedMode === 'monthly') {
                    const month = printForm.querySelector('[name="month"]').value;
                    const year = printForm.querySelector('[name="year"]').value;

                    if (!month || !year) {
                        e.preventDefault();
                        alert("Mohon isi Bulan dan Tahun.");
                        return;
                    }
                }
            });

            toggleInputVisibility(); // Jalankan saat pertama kali
        });
    </script>
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
                },
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
            });
            $('#trxRoomTable_filter input').attr('placeholder', 'Search...').css('padding-left', '25px');
        });
    </script>
    <style>
        @media (max-width: 1024px) and (orientation: landscape) {
            #trxRoomTable {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }
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