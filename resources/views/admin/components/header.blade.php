<style>
    /* Header */
    .header {
        padding: 10px;
        background-color: #ffffff;
        box-shadow: rgb(230, 231, 235) 0px 6px 12px -5px, rgba(0, 0, 0, 0.3) 0px 4px 8px -8px;
        border-radius: 10px;
        position: fixed;
        top: 10px;
        left: 305px;
        width: calc(100% - 330px);
        z-index: 999;
        transition: margin-left 0.5s ease, left 0.5s ease, width 0.5s ease;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header.collapsed {
        left: 35px;
        width: 90%;
        margin-left: 80px;
    }

    .header .header-left {
        display: flex;
        align-items: center;
    }

    .header-right .search-input {
        margin-right: 20px;
        padding: 5px;
        border-radius: 15px;
        border: 1px solid #ccc;
        width: 200px;
        transition: border-color 0.3s;
    }

    .header-right .search-input:focus {
        border-color: #007bff;
    }

    .header .header-right {
        display: flex;
        align-items: center;
    }

    .header .user-avatar {
        background-color: #007bff;
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 18px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .header .user-avatar:hover {
        background-color: #0056b3;
    }

    .user-dropdown {
        margin-top: 20px;
        padding: 10px 20px;
        display: block;
        position: absolute;
        top: 50px;
        right: 0;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: opacity 0.3s ease, visibility 0s linear 0.3s, transform 0.3s ease;
    }

    .user-dropdown.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
        transition: opacity 0.3s ease, visibility 0s linear 0s, transform 0.3s ease;
    }

    .user-dropdown a {
        padding: 10px;
        display: block;
        text-decoration: none;
        color: #333;
        transition: background-color 0.3s;
    }

    .user-dropdown a:hover {
        background-color: #f0f0f0;
    }

    @media (max-width: 768px) {
        .sidebar {
            display: none;
        }

        .header {
            width: 100%;
            height: auto;
            padding: 10px 20px;
            justify-content: center;
            top: -1px;
            border-radius: 20px;
            left: 0;
            right: 0;
        }

        .header.collapsed {
            left: 0px;
            width: 100%;
            margin-left: 0px;
        }

        .header .toggle-btn {
            display: none;
        }

        .search-input {
            display: none;
        }

        #headerTitle {
            margin-right: 100%;
        }

        .header .user-avatar {
            margin-left: 210px;
        }

    }

    #logoutForm {
        margin-right: 80px;
        margin-bottom: 10px;
    }

    .logout-btn {
        background: none;
        border: none;
        color: inherit;
        font: inherit;
        cursor: pointer;
        transition: color 0.3s, transform 0.2s;
        display: flex;
        align-items: center;
    }

    .logout-btn i {
        transition: color 0.3s;
        margin-right: 10px;
    }

    .logout-btn:hover {
        color: #ff3e1d;
        transform: translateX(5px);
        background-color: #FFE0DB;
        border-radius: 5px;
    }

    .logout-btn:hover i {
        color: #ff3e1d;
    }

    .toggle-btn {
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
        transition: transform 0.2s;
        margin-right: 10px;
        margin-left: 10px;
    }

    .toggle-btn:focus {
        outline: none;
    }

    .toggle-btn:hover {
        transform: scale(1.1);
    }

    /* Backdrop Blur */
    .header-backdrop {
        position: fixed;
        top: 0;
        left: 305px;
        width: calc(100% - 330px);
        height: 70px;
        /* Adjust to match the header height */
        z-index: 998;
        backdrop-filter: blur(5px);
        /* Adjust blur intensity */
        background-color: rgba(255, 255, 255, 0);
        /* Semi-transparent white background */
        transition: margin-left 0.5s ease, left 0.5s ease, width 0.5s ease, backdrop-filter 0.5s ease;
    }

    .header-backdrop.collapsed {
        left: 35px;
        width: 90%;
        margin-left: 80px;
    }

    @media (max-width: 768px) {
        .header-backdrop {
            left: 0;
            width: 100%;
            top: -50px;
        }
    }
</style>

<!-- Header -->
<div id="headerBackdrop" class="header-backdrop"></div>
<div id="header" class="header">
    <div class="header-left d-flex align-items-center">
        <button id="toggleSidebar" class="btn toggle-btn">
            <i class="fas fa-bars"></i>
        </button>
        <h1 id="headerTitle" class="h5 mb-0 ml-3 fw-bold">@yield('header_title', 'Dashboard')</h1>
    </div>
    <div class="header-right">
        <input type="text" class="search-input" placeholder="Search...">
        <div class="user-avatar" onclick="toggleUserDropdown()">
            <span id="userInitial">{{ session('user_name')[0] }}</span>
        </div>
        <div id="userDropdown" class="user-dropdown">
            <!-- User Info -->
            <div class="d-flex align-items-center mb-3">
                <div class="user-avatar" onclick="toggleUserDropdown()" style="margin-right:15px;">
                    <span id="userInitial">{{ session('user_name')[0] }}</span>
                </div>
                <div>
                    <div class="fw-bold">{{ session('user_name') }}</div>
                    <div class="text-muted">{{ session('user_username') }}</div>
                </div>
            </div>
            <hr>
            <!-- Navigation Links -->
            <a href="#" class="d-flex align-items-center mb-2">
                <i class="fas fa-user" style="margin-right:20px;"></i> Profile
            </a>
            <a href="#" class="d-flex align-items-center mb-3">
                <i class="fas fa-cog" style="margin-right:20px;"></i> Settings
            </a>
            <hr>
            <form action="{{ route('logout') }}" method="POST" id="logoutForm"
                class="d-flex align-items-center justify-content-end" onsubmit="return confirmLogout(event)">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function toggleUserDropdown() {
        const dropdown = document.getElementById('userDropdown');
        dropdown.classList.toggle('show');
    }

    // Close dropdown if clicked outside
    document.addEventListener('click', function (event) {
        const dropdown = document.getElementById('userDropdown');
        const trigger = document.querySelector('.user-avatar');

        // Check if the clicked target is not inside the dropdown or the trigger
        if (dropdown.classList.contains('show') && !dropdown.contains(event.target) && !trigger.contains(event.target)) {
            dropdown.classList.remove('show');
        }
    });

    function confirmLogout(event) {
        event.preventDefault(); // Prevent form submission

        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to log out!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#B82020',
            cancelButtonColor: '#666565',
            confirmButtonText: 'Yes, log out!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit(); // Submit the form
            }
        });
    }
</script>