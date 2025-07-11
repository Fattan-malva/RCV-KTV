@extends('layouts.appAdmin')
@section('title', 'Account Management')
@section('header_title', 'Customers')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h1>Account Management</h1>
                        <p>User management controls system access, assigns roles, and tracks activities to ensure security
                            and efficiency.</p>
                        @php
                            $role = session('user_role');
                        @endphp

                        @if ($role === 'superadmin')
                            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasCreateCustomer" aria-controls="offcanvasCreateCustomer">
                                <i class="fa-solid fa-address-book"></i> Add New User Account
                            </button>
                        @endif
                    </div>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('img/useradd.png') }}" alt="Image" class="img-fluid"
                            style="max-width: 120px; margin-bottom:8px; margin-right:50px;" />
                    </div>
                </div>
            </div>
            <div class="card p-4 mt-4 end-content">
                <div>
                    <table id="customerTable" class="table table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="USER">USER</th>
                                <th>ROLE</th>
                                <th>TYPE ACCOUT</th>
                                @if ($role === 'superadmin')
                                    <th>ACTION</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $index => $customer)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="USER">
                                        <div class="d-flex align-items-center">
                                            <form action="{{ route('admin.customer-edit') }}" method="POST"
                                                style="display: flex; align-items: center;">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $customer->id }}">

                                                <button type="submit"
                                                    class="border-0 p-0 bg-transparent d-flex align-items-center">
                                                    <div class="avatar"
                                                        style="background-color: {{ '#' . substr(md5(rand()), 0, 6) }};">
                                                        @php
                                                            $nameParts = explode(' ', $customer->name);
                                                            $initials = strtoupper(substr($nameParts[0], 0, 1)) . (isset($nameParts[1]) ? strtoupper(substr($nameParts[1], 0, 1)) : '');
                                                        @endphp
                                                        {{ $initials }}
                                                    </div>
                                                    <div class="ms-2 text-start">
                                                        <div class="customer-name">
                                                            {{ $customer->name }}
                                                        </div>
                                                        <div style="font-size: 12px; color: #6c757d;">{{ $customer->username }}
                                                        </div>
                                                    </div>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>{{ $customer->role }}</td>
                                    <td>{{ $customer->login_type }}</td>
                                    @if ($role === 'superadmin')
                                        <td>
                                            <div class="btn-group">
                                                <form action="{{ route('admin.customer-edit') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $customer->id }}">
                                                    <button type="submit" class="btn btn-sm border-0 btn-action" title="Detail">
                                                        <i class='bx bxs-user-detail' style="font-size: 25px;"></i>
                                                    </button>
                                                </form>

                                                <button class="btn btn-sm border-0 btn-action" title="Delete"
                                                    onclick="confirmDelete({{ $customer->id }})">
                                                    <i class='bx bxs-trash' style="font-size: 20px;"></i>
                                                </button>
                                                <!-- Dropdown Button -->
                                                <!-- <button class="btn btn-sm border-0 btn-action" data-bs-toggle="dropdown"
                                                                            aria-expanded="false" title="Option">
                                                                            <i class='bx bx-dots-vertical-rounded' style="font-size: 20px;"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a class="dropdown-item" href="#">Option 1</a></li>
                                                                            <li><a class="dropdown-item" href="#">Option 2</a></li>
                                                                        </ul> -->

                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card small mb-4">
                <h5>Small Card 1</h5>
                <p>Content for small card 1.</p>
            </div>
            <div class="card small mb-4">
                <h5>Small Card 2</h5>
                <p>Content for small card 2.</p>
            </div>
            <div class="card small mb-4">
                <h5>Small Card 3</h5>
                <p>Content for small card 3.</p>
            </div>
            <div class="card small mb-4">
                <h5>Small Card 4</h5>
                <p>Content for small card 4.</p>
            </div>
            <div class="card small" style="padding-bottom: 440px;">
                <h5>Small 5</h5>
                <p>Content for small card 4.</p>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCreateCustomer"
        aria-labelledby="offcanvasCreateCustomerLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasCreateCustomerLabel">Add New Account</h5>
        </div>
        <div class="offcanvas-body">
            <form action="{{ route('admin.customer-store') }}" method="POST">
                @csrf
                <!-- Email Input -->
                <div class="mui-input-container">
                    <input type="email" id="username" name="username" class="@error('username') is-invalid @enderror"
                        placeholder=" " value="{{ old('username') }}" required />
                    <label for="username">Email</label>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="mui-input-container">
                    <input type="password" id="password" name="password" class="@error('password') is-invalid @enderror"
                        placeholder=" " value="{{ old('password') }}" required />
                    <label for="password">Password</label>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Name Input -->
                <div class="mui-input-container">
                    <input type="text" id="name" name="name" class="@error('name') is-invalid @enderror" placeholder=" "
                        value="{{ old('name') }}" required />
                    <label for="name">Name</label>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Role Select -->
                <div class="mui-input-container">
                    <select class="mui-select @error('role') is-invalid @enderror" id="role" name="role" required>
                        <option value="" disabled selected>Choose Role</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="kasir" {{ old('role') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                    <label for="role" class="form-label">Role</label>
                    @error('role')
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if ($errors->any())
                var offcanvasElement = document.getElementById('offcanvasCreateCustomer');
                var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                offcanvas.show();
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error!',
                    text: '{{ $errors->first() }}',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
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
                    var offcanvasElement = document.getElementById('offcanvasCreateCustomer');
                    var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                    offcanvas.show();
                } else {
                    var offcanvasElement = document.getElementById('offcanvasCreateCustomer');
                    var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                    offcanvas.hide();
                }
            @endif
                        });
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#B82020',
                cancelButtonColor: '#a6a4a4',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/customer-destroy/${id}`)
                        .then(response => {
                            window.location.reload();
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'The customer has been deleted.',
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

    </script>
    <script>
        $(document).ready(function () {
            $('#customerTable').DataTable({
                responsive: true,
                paging: true,
                searching: true,
                lengthChange: true,
                autoWidth: false,
                pageLength: 10,
                pagingType: "simple_numbers",
                drawCallback: function (settings) {
                    var api = this.api();
                    var rows = api.rows({ page: 'current' }).data().length;
                    var emptyRows = 10 - rows;
                    if (emptyRows > 0) {
                        for (var i = 0; i < emptyRows; i++) {
                            $('#customerTable tbody').append(
                                '<tr class="empty-row">' +
                                '<td>&nbsp;</td>' +
                                '<td>&nbsp;</td>' +
                                '<td>&nbsp;</td>' +
                                '<td>&nbsp;</td>' +
                                '<td>&nbsp;</td>' +
                                '</tr>'
                            );
                        }
                    }
                },
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

            // Tambahkan ikon pencarian di dalam placeholder
            $('#customerTable_filter input').attr('placeholder', 'Search...').css('padding-left', '25px');
            $('#customerTable_filter input').before('<i class="fas fa-search" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%);"></i>');
        });
    </script>

    <!-- Style Page -->
    <style>
        .card {
            padding: 50px;
            border: none;
            box-shadow: rgb(230, 231, 235) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
        }

        .small {
            padding: 20px 20px;
            box-shadow: rgb(230, 231, 235) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
            margin-right: 35px;
        }

        #offcanvasCreateCustomerLabel {
            padding: 1rem 1rem;
            margin-bottom: 0;
            border-radius: 20px;
            color: #696CFF;
            background-color: rgb(235, 236, 236);
        }
    </style>
    <!-- Style Full Table -->
    <style>
        #customerTable_filter {
            margin-bottom: 15px;
            margin-left: 42%;
            position: relative;
        }

        #customerTable_filter input {
            padding-left: 50px;
            border-radius: 20px;
        }

        #customerTable_filter i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #384551;
        }

        /* Custom table header and row color */
        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_info {
            color: #5a56e0;
        }

        /* Gaya untuk halaman aktif */
        .active>.page-link,
        .page-link.active {
            background-color: #696CFF !important;
            border-radius: 7px !important;
            border: none !important;
            color: white !important;
            box-shadow: none !important;
        }

        /* Gaya untuk tombol halaman normal dan hover */
        .page-link,
        .page-link.active {
            background-color: #F2F3F4 !important;
            border-radius: 7px !important;
            border: none !important;
            color: #384551 !important;
            transition: background-color 0.3s, color 0.3s;
        }

        /* Efek hover untuk tombol halaman */
        .page-link:hover {
            background-color: rgb(213, 214, 214) !important;
            color: #696CFF !important;
        }

        /* Menghilangkan border atau box-shadow biru terang saat fokus */
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

        #customerTable td {
            width: auto;
            text-align: center;
            vertical-align: middle;
            padding: 10px;
        }

        #customerTable th {
            width: auto;
            text-align: center;
            vertical-align: middle;
            padding: 10px;
        }

        #customerTable th.USER {
            text-align: left;
            vertical-align: middle;
            padding: 10px;
        }

        #customerTable td.USER {
            text-align: left;
            vertical-align: middle;
            padding: 10px;
        }


        .empty-row td {
            height: 3.9em;
            padding: 0;
        }

        #customerTable td,
        #customerTable th {
            border-left: none;
            border-right: none;
        }

        #customerTable td,
        #customerTable th {
            border-bottom: 1px solid #ddd;
            border-top: 1px solid #ddd;
        }

        #customerTable tr:last-child td {
            border-bottom: none;
        }

        .avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 16px;
            text-transform: uppercase;
        }

        .customer-name {
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            color: black;
            transition: color 0.3s ease;
        }

        .customer-name:hover {
            color: #696CFF;
        }

        .btn-action {
            transition: transform 0.3s ease;
            color: #646E78;
        }

        /* Efek saat hover: tombol naik ke atas dengan bayangan */
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

            .small {
                display: none;
            }

            .end-content {
                margin-bottom: 7%;
            }
        }
    </style>
@endsection