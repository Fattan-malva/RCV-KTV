@extends('layouts.appLanding')

@section('title', 'About Us')

@section('content')

<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>About Us</h2>
                    <div class="bt-option">
                        <a href="{{ route('landing.index') }}"
                            class="{{ request()->routeIs('landing.index') ? 'active' : '' }}">Home</a><span>About
                            Us</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->
<!-- About Us Page Section Begin -->
<section class="aboutus-page-section spad">
    <div class="container">
        <div class="about-page-text">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ap-title">
                        <h2>Welcome To B Fashion.</h2>
                        <p>B Fashion Hotel houses a karaoke and a nightclub. It offers elegant rooms with free WiFi
                            access. Taman Anggrek Mall is a 5-minute walk away.
                            <br>
                            <br>
                            Air-conditioned rooms in B Fashion Hotel is well fitted with a seating area and a
                            flat-screen cable TV. A minibar and towels are also included. Each en suite bathroom comes
                            with shower facilities and free toiletries.
                            <br>
                            <br>
                            The hotel is a 10-minute drive from Central Park shopping mall and a 35-minute drive from
                            Soekarno-Hatta International Airport.
                            <br>
                            <br>
                            Operating a 24-hour front desk, the hotel has karaoke facilities, luggage storage and ATM
                            machine on site. Other on-site conveniences include valet parking and laundry services.
                            Buffet breakfast is served every morning with a wide range of Western and Asian Cuisine.
                            There is also a rooftop ATIZ wine & dine restaurant offering Asian-Western fusion dishes
                            where guests can also enjoy the amazing views of Jakarta's skyline.

                            A selection of international favourites can be enjoyed at Lobby Cafe or in the room with
                            room service. Buffet breakfast is served every morning.
                        </p>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <ul class="ap-services">
                        <li><i class="icon_check"></i> 20% Off On Accommodation.</li>
                        <li><i class="icon_check"></i> Complimentary Daily Breakfast</li>
                        <li><i class="icon_check"></i> 3 Pcs Laundry Per Day</li>
                        <li><i class="icon_check"></i> Free Wifi.</li>
                        <li><i class="icon_check"></i> Discount 20% On F&B</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="about-page-services">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="gallery-item set-bg" data-setbg="img/about/karaoke.jpg">
                            <div class="gi-text">
                                <h3>KTV Karaoke</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="gallery-item set-bg" data-setbg="img/about/spa.jpg">
                                    <div class="gi-text">
                                        <h3>Spa</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="gallery-item set-bg" data-setbg="img/about/atiz.jpg">
                                    <div class="gi-text">
                                        <h3>Atiz Restaurant</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="gallery-item large-item set-bg" data-setbg="img/about/club.jpg">
                            <div class="gi-text">
                                <h3>Oppai Club</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Us Page Section End -->

<!-- Video Section Begin -->
<section class="video-section set-bg" data-setbg="img/video-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="video-text">
                    <h2>Discover Our Hotel & Services.</h2>
                    <p>It S Hurricane Season But We Are Visiting Hilton Head Island</p>
                    <a href="https://www.youtube.com/watch?v=EzKkl64rRbM" class="play-btn video-popup"><img
                            src="img/play.png" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Video Section End -->

<!-- Gallery Section Begin -->
<section class="gallery-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Our Gallery</span>
                    <h2>Discover Our Work</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="gallery-item set-bg" data-setbg="img/gallery/gallery-1.jpg">
                    <div class="gi-text">
                        <h3>Room Luxury</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="gallery-item set-bg" data-setbg="img/gallery/gallery-3.jpg">
                            <div class="gi-text">
                                <h3>Room Luxury</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="gallery-item set-bg" data-setbg="img/gallery/gallery-4.jpg">
                            <div class="gi-text">
                                <h3>Room Luxury</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="gallery-item large-item set-bg" data-setbg="img/gallery/gallery-2.jpg">
                    <div class="gi-text">
                        <h3>Room Luxury</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Gallery Section End -->

@endsection