<style>
    .sidebar {
        position: fixed;
        top: 10px;
        left: 20px;
        height: 97%;
        width: 250px;
        border-radius: 10px 10px;
        background-color: rgb(255, 255, 255);
        color: black;
        transition: width 0.5s ease;
        box-shadow: rgb(230, 231, 235) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
    }

    /* .sidebar .logo {
        padding: 20px;
        text-align: center;
    }

    .sidebar .logo img {
        max-width: 80%;
        height: auto;
    } */


    .sidebar.collapsed {
        width: 80px;
    }

    .sidebar ul {
        padding: 0;
        margin-left: 22px;
        list-style-type: none;
    }

    .sidebar ul li {
        padding: 10px;
        margin-bottom: 5px;
        text-align: left;
    }

    .sidebar ul li a {
        color: black;
        text-decoration: none;
        display: flex;
        align-items: center;
    }

    .sidebar ul li a i {
        margin-right: 10px;
    }

    .sidebar ul li a span {
        opacity: 1;
        visibility: visible;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .sidebar.collapsed ul li a span {
        opacity: 0;
        visibility: hidden;
    }


    .sidebar ul li.active,
    .sidebar ul li:hover {
        background-color: #f1f1f1;
        border-radius: 10px;
        margin-right: 20px;
        color: black;
    }

    .sidebar ul li.active a {
        color: #696CFF;
        font-weight: bold;
    }

    .bottom-navbar a.active {
        background-color: #f1f1f1;
        border-radius: 10px;
        color: black;
        font-weight: bold;
    }

    @media (max-width: 768px) {
        .bottom-navbar {
            display: flex;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #343a40;
            justify-content: space-around;
            z-index: 1050;
        }

        .bottom-navbar a {
            color: #fff;
            text-decoration: none;
            text-align: center;
            padding: 10px;
            font-size: 14px;
        }

        .bottom-navbar a i {
            font-size: 18px;
            display: block;
        }
    }

    .sidebar .logo {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100px;
        cursor: pointer;
    }

    .sidebar .logo-text {
        color: #fff;
        background-color: #696cff;
        border-color: #696cff;
        box-shadow: 0 .125rem .25rem #696cff66;
        border-radius: 5px;
        padding: 5px 25px;
        font-size: 25px;
        white-space: nowrap;
        overflow: hidden;
        width: fit-content;
        transition: all 0.8s ease;
    }

    .sidebar.collapsed .logo-text {
        border-radius: 50%;
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
        text-align: center;
        line-height: 50px;
        padding: 0;
        overflow: hidden;
        transition: all 0.8s ease;
    }


    .sidebar.collapsed .logo-text::before {
        content: "B";
        display: block;
        text-align: center;
    }

   .sidebar-logout-card-user {
    position: absolute;
    bottom: 30px;
    left: 20px;
    width: 210px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(105, 108, 255, 0.08), 0 1.5px 4px rgba(0, 0, 0, 0.07);
    padding: 14px 14px 10px 14px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
    font-size: 1rem;
}
.sidebar.collapsed .sidebar-logout-card-user {
    width: 50px;
    left: 15px;
    padding: 8px 0;
    align-items: center;
}
.sidebar-user-avatar {
    background-color: #696cff;
    color: #fff;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 18px;
    font-weight: bold;
}
.sidebar.collapsed .sidebar-user-avatar {
    width: 32px;
    height: 32px;
    font-size: 1rem;
    margin-left: 9px;
}
.sidebar.collapsed .sidebar-user-name,
.sidebar.collapsed .sidebar-user-username,
.sidebar.collapsed .sidebar-logout-btn i {
    display: none;
}
.sidebar-logout-btn {
    background: none;
    border: none;
    color: #ff3e1d;
    font-weight: bold;
    font-size: 1.2rem;
    border-radius: 8px;
    padding: 6px 8px;
    transition: background 0.2s, color 0.2s;
    display: flex;
    align-items: center;
    margin-left: 8px;
}
.sidebar-logout-btn i {
    font-size: 1.2rem;
    color: #ff3e1d;
    transition: color 0.2s;
}
.sidebar-logout-btn:hover,
.sidebar-logout-btn:focus {
    background: #FFE0DB;
    color: #b82020;
    outline: none;
}
.sidebar-logout-btn:hover i {
    color: #b82020;
}
@media (max-width: 768px) {
    .sidebar-logout-card-user {
        display: none;
    }
}
</style>
<!-- Sidebar -->
<div id="sidebar" class="sidebar text-white">
    <!-- Logo -->
    <div class="logo">
        <!-- <img src="{{ asset('img/logoBadmin.png') }}" alt="Logo"> -->
        <h1 class="logo-text" id="toggleSidebar">BfashKara RCP</h1>
    </div>

    <!-- Menu Items -->
    <ul class="list-unstyled">
        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center">
                <i class="fas fa-home"></i> <span>Dashboard</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.rooms') ? 'active' : '' }}">
            <a href="{{ route('admin.rooms') }}" class="d-flex align-items-center">
                <i class="fas fa-hotel"></i> <span>Rooms</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.rooms.detail') ? 'active' : '' }}">
            <a href="{{ route('admin.rooms.detail') }}" class="d-flex align-items-center">
                <i class="fa-solid fa-clock-rotate-left"></i> <span>History</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.rooms.booking') ? 'active' : '' }}">
            <a href="{{ route('admin.rooms.booking') }}" class="d-flex align-items-center">
                <i class="fa-solid fa-list-check"></i> <span>Booking</span>
            </a>
        </li>
        <li
            class="{{ request()->routeIs('admin.user-management') || request()->routeIs('admin.customer-edit') ? 'active' : '' }}">
            <a href="{{ route('admin.user-management') }}" class="d-flex align-items-center">
                <i class="fas fa-users"></i> <span>Customers</span>
            </a>
        </li>

        <li><a href="#" class="d-flex align-items-center"><i class="fas fa-cog"></i> <span>Settings</span></a></li>
    </ul>

   <div class="sidebar-logout-card-user">
    <div class="d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center">
            <div class="sidebar-user-avatar">
                <span>{{ session('user_name')[0] ?? 'U' }}</span>
            </div>
            <div class="ms-2" style="overflow:hidden;">
                <div class="fw-bold sidebar-user-name" style="font-size:1rem; color:black;">{{ session('user_name') }}</div>
                <div class="text-muted sidebar-user-username" style="font-size:0.85rem;">{{ session('user_username') }}</div>
            </div>
        </div>
        <form action="{{ route('logout') }}" method="POST" id="logoutFormSidebar"
            onsubmit="return confirmLogoutSidebar(event)">
            @csrf
            <button type="submit" class="sidebar-logout-btn d-flex align-items-center justify-content-center" title="Logout">
                <i class="fas fa-sign-out-alt"></i>
            </button>
        </form>
    </div>
</div>
</div>

<!-- Bottom Navbar for Mobile -->
<div class="bottom-navbar d-md-none">
    <a href="#" class="text-white"><i class="fas fa-home"></i><br>Home</a>
    <a href="#" class="text-white"><i class="fas fa-user"></i><br>Profile</a>
    <a href="#" class="text-white"><i class="fas fa-cog"></i><br>Settings</a>
    <a href="#" class="text-white"><i class="fas fa-chart-bar"></i><br>Reports</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebarCollapsedKey = "sidebar-collapsed";

        // Set initial state from localStorage
        const isCollapsed = localStorage.getItem(sidebarCollapsedKey) === "true";
        if (isCollapsed) {
            sidebar.classList.add('collapsed');
            if (content) content.classList.add('collapsed');
        }

        toggleBtn.addEventListener('click', function () {
            const collapsed = sidebar.classList.toggle('collapsed');
            if (content) content.classList.toggle('collapsed');
            localStorage.setItem(sidebarCollapsedKey, collapsed);
        });
    });

    function confirmLogoutSidebar(event) {
        event.preventDefault();
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
                document.getElementById('logoutFormSidebar').submit();
            }
        });
        return false;
    }
</script>