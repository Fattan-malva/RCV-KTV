<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>
<!-- Header Section Begin -->
<header class="header-section">
    <div class="top-nav">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="tn-left">
                        <li><i class="fa fa-phone"></i> (021) 29666777</li>
                        <li>
                            <i class="fa fa-envelope"></i>
                            <a href="mailto:reservation@bfashion.co.id"
                                class="email-link">reservation@bfashion.co.id</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="tn-right">
                        <div class="top-social">
                            <a href="https://www.instagram.com/bfashionhotel/" target="_blank"><i
                                    class="bx bxl-instagram-alt" style="font-size:20px;"></i></a>
                            <a href="https://www.tiktok.com/@bfashionhotel" target="_blank"><i class="bx bxl-tiktok"
                                    style="font-size:20px;"></i></a>
                            <a href="https://x.com/bfashionjkt" target="_blank"><i class="bx bxl-twitter"
                                    style="font-size:20px;"></i></a>
                        </div>
                        <a href="{{route("login")}}" class="bk-btn">Booking Now</a>
                        <!-- <div class="language-option">
                            <img src="img/flag.jpg" alt="">
                            <span>EN <i class="fa fa-angle-down"></i></span>
                            <div class="flag-dropdown">
                                <ul>
                                    <li><a href="#">Zi</a></li>
                                    <li><a href="#">Fr</a></li>
                                </ul>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="menu-item">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="logo">
                        <a href="{{ route('landing.index') }}">
                            <img src="img/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="nav-menu">
                        <nav class="mainmenu">
                            <ul>
                                <li class="menu-item">
                                    <a href="{{ route('landing.index') }}"
                                        class="{{ request()->routeIs('landing.index') ? 'active' : '' }}">Home</a>
                                </li>
                                <li class="menu-item">
                                    <a href="{{ route('landing.about') }}"
                                        class="{{ request()->routeIs('landing.about') ? 'active' : '' }}">About Us</a>
                                </li>
                                <li class="menu-item">
                                    <a href="{{ route('landing.rooms') }}"
                                        class="{{ request()->routeIs('landing.rooms') ? 'active' : '' }}">Rooms</a>
                                </li>
                                <li class="menu-item">
                                    <a href="{{ route('landing.news') }}"
                                        class="{{ request()->routeIs('landing.news') ? 'active' : '' }}">News</a>
                                </li>
                                <li class="menu-item">
                                    <a href="{{ route('landing.contact') }}"
                                        class="{{ request()->routeIs('landing.contact') ? 'active' : '' }}">Contact</a>
                                </li>
                            </ul>
                        </nav>
                        <div class="nav-right search-switch">
                            <i class="icon_search"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header End -->
<!-- Offcanvas Menu Section Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="canvas-open">
    <i class="icon_menu"></i>
</div>
<div class="offcanvas-menu-wrapper">
    <div class="canvas-close">
        <i class="icon_close"></i>
    </div>
    <div class="search-icon  search-switch">
        <i class="icon_search"></i>
    </div>
    <div class="header-configure-area">
        <!-- <div class="language-option">
                <img src="img/flag.jpg" alt="">
                <span>EN <i class="fa fa-angle-down"></i></span>
                <div class="flag-dropdown">
                    <ul>
                        <li><a href="#">Zi</a></li>
                        <li><a href="#">Fr</a></li>
                    </ul>
                </div>
            </div> -->
        <a href="{{route("login")}}" class="bk-btn">Booking Now</a>
    </div>
    <nav class="mainmenu mobile-menu">
        <ul>
            <li>
                <a href="{{ route('landing.index') }}"
                    class="{{ request()->routeIs('landing.index') ? 'active' : '' }}">Home</a>
            </li>
            <li>
                <a href="{{ route('landing.about') }}"
                    class="{{ request()->routeIs('landing.about') ? 'active' : '' }}">About Us</a>
            </li>
            <li>
                <a href="{{ route('landing.rooms') }}"
                    class="{{ request()->routeIs('landing.rooms') ? 'active' : '' }}">Rooms</a>
            </li>
            <li>
                <a href="{{ route('landing.news') }}"
                    class="{{ request()->routeIs('landing.news') ? 'active' : '' }}">News</a>
            </li>
            <li>
                <a href="{{ route('landing.contact') }}"
                    class="{{ request()->routeIs('landing.contact') ? 'active' : '' }}">Contact</a>
            </li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="top-social">
        <a href="https://www.instagram.com/bfashionhotel/" target="_blank"><i class="bx bxl-instagram-alt"
                style="font-size:20px;"></i></a>
        <a href="https://www.tiktok.com/@bfashionhotel" target="_blank"><i class="bx bxl-tiktok"
                style="font-size:20px;"></i></a>
        <a href="https://x.com/bfashionjkt" target="_blank"><i class="bx bxl-twitter" style="font-size:20px;"></i></a>
    </div>
    <ul class="top-widget">
        <li><i class="fa fa-phone"></i> (021) 29666777</li>
        <li><i class="fa fa-envelope"></i> reservation@bfashion.co.id</li>
    </ul>
</div>
<!-- Offcanvas Menu Section End -->
<!-- Search model Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch"><i class="icon_close"></i></div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
<!-- Search model end -->
<!-- Scroll Back to Top Button -->
<div id="scrollToTop" style="position: fixed; bottom: 50px; right: 30px; display: none; z-index: 1000;">
    <button class="btn btn-primary" style="border-radius: 50%; padding: 10px 17px; font-size: 18px;">
        <i class="fa fa-angle-up"></i>
    </button>
</div>

<style>
    #scrollToTop button {
        background-color: #b82020;
        border: none;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    #scrollToTop button:hover {
        background-color: rgb(195, 18, 18);
    }
</style>
<script>
    // Show or hide the scroll button
    window.onscroll = function () {
        const scrollToTopButton = document.getElementById('scrollToTop');
        if (document.documentElement.scrollTop > 100 || document.body.scrollTop > 100) {
            scrollToTopButton.style.display = "block";
        } else {
            scrollToTopButton.style.display = "none";
        }
    };

    // Scroll back to the top
    document.getElementById('scrollToTop').onclick = function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };
</script>