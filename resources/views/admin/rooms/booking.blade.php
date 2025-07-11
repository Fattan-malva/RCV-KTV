@extends('layouts.appAdmin')
@section('title', 'Booking List')
@section('header_title', 'Room Transactions')
@section('content')
    <div class="container-content">
        <div class="card p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h1>Booking List</h1>
                    <p>Manage Booking List, check-in/out, and guest information.</p>
                    <p><strong>Checked-In:</strong> Guests who have booked have checked in <br>
                        <strong>Expired (Check-In):</strong> Booking List has expired and the Guest has checked in <br>
                        <strong>Expired (Unchecked-In):</strong> Booking List expired because 3 hours have passed and the guest did not check
                        in</p>
                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasCreateTrxRoomDetail" aria-controls="offcanvasCreateTrxRoomDetail">
                        <i class="fa-solid fa-plus"></i> Add New Booking List
                    </button>
                    <button class="btn btn-secondary ms-2" id="showAllLogs"> <i class="fa-solid fa-list"></i> Show Booking
                        Cancel</button>
                </div>
                <div class="d-flex align-items-center">
                    <img src="{{ asset('img/bookinglist.png') }}" alt="Image" class="img-fluid"
                        style="max-width: 120px; margin-bottom:8px; margin-right:50px;" />
                </div>
            </div>
        </div>
        <div class="card p-4 mt-4 end-content">
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
                    <form action="{{ route('admin.booking.print-booking') }}" method="GET" target="_blank" id="printForm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="printModalLabel">Print Booking Report</h5>
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
                                        Filter by Month & Year
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
                <table id="trxRoomTable" class="table table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Trx Date</th>
                            <th>Booking At</th>
                            <th>Room</th>
                            <th>Guest</th>
                            <th>RCP</th>
                            <th>Notes</th>
                            <th>BookPack</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookinglist as $index => $booking)
                            @php
                                $isCheckedIn = $booking->IsCheckedIn == 1;
                                $timeIn = $booking->TimeIn ? \Carbon\Carbon::parse($booking->TimeIn) : null;

                                // Expired Check-in: sudah check-in dan sudah lewat 1 jam dari TimeIn
                                $isExpiredCheckin = $isCheckedIn && $timeIn && $timeIn->copy()->addHour()->lt(now());

                                // Expired Uncheck-in: belum check-in dan sudah lewat 3 jam dari TimeIn
                                $isExpiredUncheckin = ($booking->IsCheckedIn == 0) && $timeIn && $timeIn->copy()->addHours(3)->lt(now());

                                $isExpired = $isExpiredCheckin || $isExpiredUncheckin;
                            @endphp
                            <tr @if($isExpiredCheckin || $isExpiredUncheckin) style="background-color: #f0f0f0; color: #aaa;"
                            @elseif($isCheckedIn) style="background-color: #e0ffe0; color: #1a7f37;" @endif>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->TrxDate)->format('d M Y') }}</td>
                                <td>
                                    {{ $booking->TimeIn ? \Carbon\Carbon::parse($booking->TimeIn)->format('d M Y H:i') : '-' }}
                                    @if($isExpiredCheckin)
                                        <span class="badge bg-secondary ms-2">Expired (Check-in)</span>
                                    @elseif($isExpiredUncheckin)
                                        <span class="badge bg-dark ms-2">Expired (Uncheck-in)</span>
                                    @elseif($isCheckedIn)
                                        <span class="badge bg-success ms-2">Checked In</span>
                                    @endif
                                </td>
                                <td>{{ $booking->RoomId }}</td>
                                <td>
                                    <div>
                                        <strong>{{ $booking->GuestName }}</strong>
                                    </div>
                                </td>
                                <td>{{ $booking->ReservationWith ?? '-' }}</td>
                                <td>{{ $booking->Notes ?? '-' }}</td>
                                <td>{{ $booking->BookPack ?? '-' }}</td>
                                <td>
                                    @if(!$isExpired && !$isCheckedIn)
                                        <button class="btn btn-primary btn-sm edit-booking-btn" data-trxid="{{ $booking->TrxId }}">
                                            <i class="fa fa-clock"></i> Reschedule
                                        </button>
                                        <button class="btn btn-danger btn-sm" onclick="cancelBooking('{{ $booking->TrxId }}')">
                                            <i class="fa fa-times"></i>
                                            Cancel Booking
                                        </button>
                                    @else
                                        <span class="text-muted">No Action</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- offcanvas add booking -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCreateTrxRoomDetail"
        aria-labelledby="offcanvasCreateTrxRoomDetailLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasCreateTrxRoomDetailLabel">Add New Booking List</h5>
        </div>
        <div class="offcanvas-body">
            <form action="{{ route('admin.trx-room-booking.store') }}" method="POST">
                @csrf
                <input type="hidden" name="IsCheckedIn" value="0">
                <div class="mui-input-container">
                    <input type="text" name="GuestName" class="@error('GuestName') is-invalid @enderror" required>
                    <label>Guest Name</label>
                    @error('GuestName')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mui-input-container">
                    <input type="text" name="ReservationWith" class="@error('ReservationWith') is-invalid @enderror"
                        required>
                    <label>Reservation With</label>
                    @error('ReservationWith')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mui-input-container">
                    <select name="RoomId" class="@error('RoomId') is-invalid @enderror" required>
                        <option value="">Select Room</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->roomId }}">{{ $room->name }} ({{ $room->roomId }})</option>
                        @endforeach
                    </select>
                    <label>Room Name</label>
                    @error('RoomId')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mui-input-container">
                    <input type="datetime-local" name="TimeIn" class="@error('TimeIn') is-invalid @enderror" required>
                    <label>Check In Date & Time</label>
                    @error('TimeIn')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mui-input-container">
                    <input type="number" name="BookPack" class="@error('BookPack') is-invalid @enderror">
                    <label>Booking Package</label>
                    @error('BookPack')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mui-input-container">
                    <input type="text" name="Notes" class="@error('Notes') is-invalid @enderror">
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
    <!-- Modal Update Booking -->
    <div class="modal fade" id="updateBookingModal" tabindex="-1" aria-labelledby="updateBookingModalLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="updateBookingForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateBookingModalLabel">Reschedule Booking</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editTrxId" name="TrxId">
                        <div class="mui-input-container">
                            <input type="text" id="editGuestName" name="GuestName" required readonly>
                            <label>Guest Name</label>
                        </div>
                        <div class="mui-input-container">
                            <input type="text" id="editReservationWith" name="ReservationWith" required readonly>
                            <label>Reservation With</label>
                        </div>
                        <div class="mui-input-container">
                            <select id="editRoomId" name="RoomId" required>
                                <option value="">Select Room</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->roomId }}">{{ $room->name }} ({{ $room->roomId }})</option>
                                @endforeach
                            </select>
                            <label>Room Name</label>
                        </div>
                        <div class="mui-input-container">
                            <input type="datetime-local" id="editTimeIn" name="TimeIn" required>
                            <label>Check In Date & Time</label>
                        </div>
                        <div class="mui-input-container">
                            <input type="text" id="editBookPack" name="BookPack">
                            <label>Booking Package</label>
                        </div>
                        <div class="mui-input-container">
                            <input type="text" id="editNotes" name="Notes">
                            <label>Notes</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Log -->
    <div class="modal fade" id="logModal" tabindex="-1" aria-labelledby="logModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-large">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logModalLabel">Canceled Booking List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Tombol trigger modal cetak PDF khusus Cancelled Booking -->
                    <button class="btn mb-3 open-print-modal" style="background-color: #ae2f2f; color: white;">
                        <i class="fa fa-print"></i> Print PDF
                    </button>

                    <table class="table table-responsive" id="logTable">
                        <thead>
                            <tr>
                                <th>TrxId</th>
                                <th>TrxDate</th>
                                <th>TrxTime</th>
                                <th>Room Name</th>
                                <th>Guest Name</th>
                                <th>RCP</th>
                                <th>Booking At</th>
                                <th class="text-wrap">Reason</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data log akan diisi via JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Opsi Cetak PDF Canceled Booking -->
    <div class="modal fade" id="printModalCB" tabindex="-1" aria-labelledby="printModalCBLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.booking.print-cancelled-booking') }}" method="GET" target="_blank"
                id="printFormCB">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="printModalCBLabel">Print Canceled Booking Report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Pilihan Rentang -->
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="mode_cb" value="range" id="modeRangeCB"
                                checked>
                            <label class="form-check-label" for="modeRangeCB">
                                Filter by Date Range
                            </label>
                        </div>
                        <div id="rangeInputsCB" class="mb-3">
                            <label>Start Date</label>
                            <input type="date" name="start_date" class="form-control mb-2">
                            <label>End Date</label>
                            <input type="date" name="end_date" class="form-control">
                        </div>

                        <!-- Pilihan Bulanan -->
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="mode_cb" value="monthly" id="modeMonthlyCB">
                            <label class="form-check-label" for="modeMonthlyCB">
                                Filter by Month & Year
                            </label>
                        </div>
                        <div id="monthlyInputsCB" class="mb-3" style="display: none;">
                            <label>Month</label>
                            <select name="month" class="form-control mb-2">
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month($m)->format('F') }}</option>
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


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Tambahkan di bagian script
        function cancelBooking(trxId) {
            Swal.fire({
                title: 'Cancel Booking',
                input: 'text',
                inputLabel: 'Reason',
                inputPlaceholder: 'Enter reason for cancellation',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Reason is required!';
                    }
                },
                showCancelButton: true,
                confirmButtonText: 'Yes, cancel it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/rooms/booking/' + trxId,
                        type: 'DELETE',
                        data: {
                            Reason: result.value,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            if (response.success) {
                                Swal.fire('Cancelled!', 'Booking has been cancelled.', 'success').then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error', response.message, 'error');
                            }
                        },
                        error: function (xhr) {
                            Swal.fire('Error', xhr.responseJSON.message || 'Something went wrong.', 'error');
                        }
                    });
                }
            });
        }
        $(document).ready(function () {
            // ...existing DataTable code...

            // Edit Booking Button Click
            $('.edit-booking-btn').on('click', function () {
                const trxId = $(this).data('trxid');
                $.get(`/admin/trx-room-booking/${trxId}/edit`, function (data) {
                    $('#editTrxId').val(data.TrxId);
                    $('#editGuestName').val(data.GuestName);
                    $('#editReservationWith').val(data.ReservationWith);
                    $('#editRoomId').val(data.RoomId);
                    $('#editTimeIn').val(data.TimeIn ? data.TimeIn.replace(' ', 'T') : '');
                    $('#editBookPack').val(data.BookPack);
                    $('#editNotes').val(data.Notes);
                    $('#updateBookingForm').attr('action', `/admin/trx-room-booking/${trxId}`);
                    $('#updateBookingModal').modal('show');
                });
            });

            // Submit Update Booking
            $('#updateBookingForm').on('submit', function (e) {
                e.preventDefault();
                const form = $(this);
                const actionUrl = form.attr('action');
                const formData = form.serialize();

                $.ajax({
                    url: actionUrl,
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        if (response.success) {
                            $('#updateBookingModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Updated!',
                                text: 'Booking updated successfully.',
                                toast: true,
                                position: 'top',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            setTimeout(() => window.location.reload(), 1200);
                        }
                    },
                    error: function (xhr) {
                        Swal.fire('Error!', 'Failed to update booking.', 'error');
                    }
                });
            });
        });
        $('#showAllLogs').on('click', function () {
            $.get('/admin/rooms/booking/logs', function (data) {
                var rows = '';
                if (data.length === 0) {
                    rows = '<div style="text-align:center;"></div>';
                } else {
                    $.each(data, function (i, log) {
                        rows += '<tr>' +
                            '<td>' + log.TrxId + '</td>' +
                            '<td>' + log.TrxDate + '</td>' +
                            '<td>' + log.TrxTime + '</td>' +
                            '<td>' + log.RoomId + '</td>' +
                            '<td>' + log.GuestName + '</td>' +
                            '<td>' + log.ReservationWith + '</td>' +
                            '<td>' + log.TimeIn + '</td>' +
                            '<td class="text-wrap">' + log.Reason + '</td>' +
                            '</tr>';
                    });
                }
                $('#logTable tbody').html(rows);
                $('#logModal').modal('show');
            });
        });
        $('#logModal').on('shown.bs.modal', function () {
            // Jika sudah ada instance DataTable, destroy dulu
            if ($.fn.DataTable.isDataTable('#logTable')) {
                $('#logTable').DataTable().destroy();
            }
            // Inisialisasi ulang DataTable setelah data dimasukkan
            $('#logTable').DataTable({
                responsive: true,
                paging: true,
                searching: true,
                ordering: true,
                lengthChange: true,
                pageLength: 10,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                language: {
                    lengthMenu: "_MENU_",
                }
            });
        });
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
    <!-- print booking list -->
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
                        alert("Mohon isi Start Date dan End Date.");
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
    <!-- print canceled booking list-->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Handle tombol print CB
            document.querySelectorAll('.open-print-modal').forEach(button => {
                button.addEventListener('click', function () {
                    const logModal = bootstrap.Modal.getInstance(document.getElementById('logModal'));
                    logModal.hide();

                    setTimeout(() => {
                        const printModalCB = new bootstrap.Modal(document.getElementById('printModalCB'));
                        printModalCB.show();
                    }, 500);
                });
            });

            // Toggle input CB berdasarkan pilihan
            const modeRadiosCB = document.querySelectorAll('input[name="mode_cb"]');
            const rangeInputsCB = document.querySelector('#rangeInputsCB');
            const monthlyInputsCB = document.querySelector('#monthlyInputsCB');
            const printFormCB = document.getElementById('printFormCB');

            function toggleInputCB() {
                const selected = document.querySelector('input[name="mode_cb"]:checked').value;
                if (selected === 'range') {
                    rangeInputsCB.style.display = 'block';
                    monthlyInputsCB.style.display = 'none';
                } else {
                    rangeInputsCB.style.display = 'none';
                    monthlyInputsCB.style.display = 'block';
                }
            }

            modeRadiosCB.forEach(radio => {
                radio.addEventListener('change', toggleInputCB);
            });

            printFormCB.addEventListener('submit', function (e) {
                const selected = document.querySelector('input[name="mode_cb"]:checked').value;

                if (selected === 'range') {
                    const start = printFormCB.querySelector('[name="start_date"]').value;
                    const end = printFormCB.querySelector('[name="end_date"]').value;

                    if (!start || !end) {
                        e.preventDefault();
                        alert("Mohon isi Start Date dan End Date.");
                        return;
                    }
                } else {
                    const month = printFormCB.querySelector('[name="month"]').value;
                    const year = printFormCB.querySelector('[name="year"]').value;

                    if (!month || !year) {
                        e.preventDefault();
                        alert("Mohon isi Bulan dan Tahun.");
                        return;
                    }
                }
            });

            toggleInputCB();
        });

    </script>



    <style>
        @media (max-width: 1024px) and (orientation: landscape) {
            #trxRoomTable {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .edit-booking-btn {
                display: block;
                margin-bottom: 10px;
                width: 100%;
            }

            .btn-danger {
                display: block;
                width: 100%;
            }
        }

        .text-wrap {
            white-space: normal !important;
            word-break: break-word;
            max-width: 200px;
            /* Atur sesuai kebutuhan */
        }

        /* Copy style dari user management agar konsisten */
        .card {
            padding: 20px;
            border: none;
            box-shadow: rgb(230, 231, 235) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
        }

        .modal-large {
            max-width: 90vw;
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

            #showAllLogs {
                margin-left: 0 !important;
                margin-top: 4%;
            }

            .end-content {
                margin-bottom: 7%;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("input[name='TimeIn']", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true
        });
    </script>
@endsection