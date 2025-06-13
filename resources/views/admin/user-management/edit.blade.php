@extends('layouts.appAdmin')
@section('header_title')
    <a href="{{ route('admin.user-management') }}" class="text-decoration-none text-black">
        Customers
    </a>
    /
    <span style="color:#b0aeae;">Detail</span>
@endsection
@section('content')
    <style>
        .card {
            padding: 50px;
            border: none;
            box-shadow: rgb(230, 231, 235) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
        }

        /* Styling for portrait cards */
        .portrait-card {
            height: 600px;
            box-shadow: rgb(230, 231, 235) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
            padding: 15px;
        }

        .landscape-card {
            height: 320px;
            width: 128%;
            box-shadow: rgb(230, 231, 235) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
            padding: 15px;
            text-align: center;
        }

        .avatar {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 60px;
            text-transform: uppercase;
            margin: 0 auto;
        }

        .card-body {
            text-align: center;

        }

        .card-footer {
            text-align: left;
        }

        .card-footer .row {
            margin-top: 20px;
        }

        .card-footer .form-label {
            font-weight: bold;
        }

        .card-footer .form-control-plaintext {
            color: #6c757d;
            font-size: 14px;
        }

        .nav-lanscape {
            transition: background-color 0.5s ease;
            border: none;
            color: #595d60;
            font-weight: bold;
        }

        /* Efek Hover */
        .nav-lanscape:hover {
            background-color: rgb(235, 236, 236);
            color: #696cff;
        }

        /* Efek Aktif */
        .nav-lanscape.active {
            background-color: #696cff;
            color: white;
            border-color: #696cff;
        }
    </style>
    <div class="row">
        <div class="col-md-4">
            <div class="card portrait-card">
                <div class="card-body text-center">
                    <a href="{{ route('admin.user-management') }}" class="btn btn-light me-2" title="Back"
                        style="height:48px;width:48px;display:flex;align-items:center;justify-content:center; border-radius: 50px;">
                        <i class="fas fa-angle-left" style="font-size: 22px; color: #696cff;"></i>
                    </a>
                    <!-- Avatar (di tengah dan lebih besar) -->
                    <div class="avatar mb-3" style="background-color: {{ '#' . substr(md5($customer->name), 0, 6) }};">
                        @php
                            $nameParts = explode(' ', $customer->name);
                            $initials = strtoupper(substr($nameParts[0], 0, 1)) . (isset($nameParts[1]) ? strtoupper(substr($nameParts[1], 0, 1)) : '');
                        @endphp
                        {{ $initials }}
                    </div>
                    <!-- Name (tengah card) -->
                    <h5 class="mb-1" style="font-weight: bold;">{{ $customer->name }}</h5>
                    <!-- Role (di bawah name) -->
                    @php
                        $roleColor = '';
                        $roleBgColor = '';
                        switch (strtolower($customer->login_type)) {
                            case 'master':
                                $roleColor = '#ff3e1d';
                                $roleBgColor = '#ffe0db';
                                break;
                            case 'google account':
                                $roleColor = '#0f9403';
                                $roleBgColor = 'rgba(13, 255, 9, 0.34)';
                                break;
                            case 'register account':
                                $roleColor = '#696cff';
                                $roleBgColor = 'rgb(235, 236, 236)';
                                break;
                            case 'created by admin':
                                $roleColor = '#fcc308';
                                $roleBgColor = 'rgba(255, 183, 0, 0.21)';
                                break;
                            default:
                                $roleColor = 'white';
                                $roleBgColor = 'gray';
                                break;
                        }
                    @endphp
                    <p class="mb-3"
                        style="font-size: 14px; color: {{ $roleColor }}; background-color: {{ $roleBgColor }}; font-weight: bold; padding: 5px 10px; border-radius: 5px; display: inline-block;">
                        {{ $customer->login_type }}
                    </p>
                </div>
                <!-- Customer Details (berjajar) -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="name" class="form-label">Name:</label>
                            <p id="name" class="form-control-plaintext">{{ $customer->name }}</p>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="username" class="form-label">Email:</label>
                            <p id="username" class="form-control-plaintext">{{ $customer->username }}</p>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="role" class="form-label">Role:</label>
                            <p id="role" class="form-control-plaintext">{{ $customer->role }}</p>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="type" class="form-label">Account Type:</label>
                            <p id="type" class="form-control-plaintext">{{ $customer->login_type }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <!-- Row untuk Button seperti Navbar -->
            <div class="row mb-3">
                <div class="col d-flex justify-content-start">
                    <!-- Navbar Buttons untuk memilih Landscape -->
                    <button class="btn nav-lanscape me-2" id="landscape1Btn"
                        onclick="setActiveButton('landscape1Btn')">Profile</button>
                    <!-- <button class="btn nav-lanscape me-2" id="landscape2Btn"
                                                        onclick="setActiveButton('landscape2Btn')">Landscape 2</button>
                                                    <button class="btn nav-lanscape" id="landscape3Btn" onclick="setActiveButton('landscape3Btn')">Landscape
                                                        3</button> -->
                </div>
            </div>

            <!-- Card untuk Konten Landscape 1 -->
            <div class="card landscape-card" id="landscape1" style="display: block;">
                <!-- Tombol Edit / Cancel -->
                @php
                    $role = session('user_role');
                @endphp
                @if ($role === 'superadmin')
                    <div class="text-end mb-3">
                        <button type="button" id="editProfileBtn" class="btn btn-secondary">Edit Profile</button>
                    </div>
                @endif

                <form action="{{ route('admin.customer-update', $customer->id) }}" method="POST" style="margin: 0 auto;">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3 text-start">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control editable" id="name" name="name"
                                value="{{ $customer->name }}" required readonly>
                        </div>
                        <div class="col-md-6 mb-3 text-start">
                            <label for="username" class="form-label">Email</label>
                            <input type="email" class="form-control editable" id="username" name="username"
                                value="{{ $customer->username }}" required readonly>
                        </div>
                        <div class="col-md-6 mb-3 text-start">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control editable" id="role" name="role" required disabled>
                                <option value="admin" {{ $customer->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ $customer->role == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3 text-start">
                            <label for="password" class="form-label">Password <span
                                    style="font-size:12px;color:#888;">(Kosongkan jika tidak ingin mengubah)</span></label>
                            <input type="password" class="form-control editable" id="password" name="password"
                                autocomplete="new-password" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-end">
                            <button type="submit" id="updateBtn" class="btn btn-primary mt-2"
                                style="display: none;">Update</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Card untuk Konten Landscape 2 -->
            <div class="card landscape-card" id="landscape2" style="display: none;">
                <div class="card-body">
                    <h5>Landscape 2</h5>
                    <p>Content for landscape 2.</p>
                </div>
            </div>

            <!-- Card untuk Konten Landscape 3 -->
            <div class="card landscape-card" id="landscape3" style="display: none;">
                <div class="card-body">
                    <h5>Landscape 3</h5>
                    <p>Content for landscape 3.</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        const editBtn = document.getElementById('editProfileBtn');
        const updateBtn = document.getElementById('updateBtn');
        const formElements = document.querySelectorAll('.editable');

        // Simpan nilai awal form
        let initialValues = {};
        formElements.forEach(el => {
            initialValues[el.name] = el.value;
        });

        editBtn.addEventListener('click', function () {
            const isEditing = editBtn.textContent === 'Cancel';

            if (isEditing) {
                // Kembali ke read-only
                formElements.forEach(el => {
                    el.setAttribute('readonly', true);
                    el.setAttribute('disabled', true);

                    // Reset value ke awal
                    if (el.tagName === 'SELECT') {
                        el.value = initialValues[el.name];
                    } else if (el.name !== 'password') {
                        el.value = initialValues[el.name];
                    } else {
                        el.value = ''; // password dikosongkan
                    }
                });

                editBtn.textContent = 'Edit Profile';
                updateBtn.style.display = 'none';
            } else {
                // Aktifkan edit
                formElements.forEach(el => {
                    el.removeAttribute('readonly');
                    el.removeAttribute('disabled');
                });

                editBtn.textContent = 'Cancel';
                updateBtn.style.display = 'inline-block';
            }
        });
    </script>
    <script>
        // Fungsi untuk menambahkan efek aktif pada tombol
        function setActiveButton(buttonId) {
            // Menghapus kelas 'active' dari semua tombol
            document.querySelectorAll('.btn').forEach(btn => btn.classList.remove('active'));

            // Menambahkan kelas 'active' dan 'btn-dark' ke tombol yang dipilih
            document.getElementById(buttonId).classList.add('active');

            // Mengatur tampilan konten berdasarkan tombol yang dipilih
            document.getElementById("landscape1").style.display = "none";
            document.getElementById("landscape2").style.display = "none";
            document.getElementById("landscape3").style.display = "none";

            if (buttonId === "landscape1Btn") {
                document.getElementById("landscape1").style.display = "block";
            } else if (buttonId === "landscape2Btn") {
                document.getElementById("landscape2").style.display = "block";
            } else if (buttonId === "landscape3Btn") {
                document.getElementById("landscape3").style.display = "block";
            }
        }

        // Mengatur default active pada tombol pertama
        window.onload = function () {
            setActiveButton('landscape1Btn');
        }
    </script>
@endsection