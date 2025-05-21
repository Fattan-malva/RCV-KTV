@extends('layouts.appLanding')

@section('title', 'Detail Rooms')

@section('content')

<style>
    .image-gallery {
        text-align: center;
    }

    .main-image-container {
        width: 100%;
        max-width: 800px;
        aspect-ratio: 16 / 9;
        margin-bottom: 20px;
        position: relative;
        overflow: hidden;
    }

    .main-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .thumbnail-row {
        display: flex;
        justify-content: center;
        gap: 20px;
    }

    .thumbnail {
        width: 100%;
        max-width: 180px;
        object-fit: cover;
        cursor: pointer;
        border: 2px solid transparent;
        transition: border 0.3s ease, transform 0.2s ease;
    }

    .thumbnail:hover {
        border-color: #B82020;
        transform: scale(1.05);
    }
    @media (max-width: 768px) {
        .main-image-container {
            width: 100%;
            max-width: 800px;
            aspect-ratio: 16 / 9;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
        }

        .col-lg-8 {
            order: 2;
        }

        .col-lg-4 {
            order: 1; 
            margin-bottom: 20px;
        }

        .thumbnail {
            max-width: 100px;
        }
    }

    /* Very small screens (below 480px) */
    @media (max-width: 480px) {
        .main-image-container {
        }

        .thumbnail {
            max-width: 100px;
        }

        .reservation-form {
            width: 100%;
        }
    }
</style>

<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Detail Room</h2>
                    <div class="bt-option">
                        <a href="{{ route('landing.index') }}"
                            class="{{ request()->routeIs('landing.index') ? 'active' : '' }}">Home</a>
                        <a href="{{ route('landing.rooms') }}"
                            class="{{ request()->routeIs('landing.rooms') ? 'active' : '' }}">Rooms</a>
                        <span>Detail Room</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Room Details Section Begin -->
<section class="room-details-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="room-details-item">
                    <div class="image-gallery">
                        <!-- Gambar Utama -->
                        <div class="main-image-container">
                            <img class="main-image" src="img/room/room-details.jpg" alt="Main Room" id="mainImage">
                        </div>

                        <!-- Gambar Thumbnail -->
                        <div class="thumbnail-row">
                            <img class="thumbnail" src="img/room/room-1.jpg" alt="Thumbnail 1">
                            <img class="thumbnail" src="img/room/room-2.jpg" alt="Thumbnail 2">
                            <img class="thumbnail" src="img/room/room-3.jpg" alt="Thumbnail 3">
                        </div>
                    </div>


                    <div class="rd-text">
                        <div class="rd-title">
                            <h3>Premium King Room</h3>
                            <div class="rdt-right">
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star-half_alt"></i>
                                </div>
                                <!-- <a href="#">Booking Now</a> -->
                            </div>
                        </div>
                        <h2>159$<span>/Pernight</span></h2>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="r-o">Size:</td>
                                    <td>30 ft</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Capacity:</td>
                                    <td>Max persion 5</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Bed:</td>
                                    <td>King Beds</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Services:</td>
                                    <td>Wifi, Television, Bathroom,...</td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="f-para">Motorhome or Trailer that is the question for you. Here are some of the
                            advantages and disadvantages of both, so you will be confident when purchasing an RV.
                            When comparing Rvs, a motorhome or a travel trailer, should you buy a motorhome or fifth
                            wheeler? The advantages and disadvantages of both are studied so that you can make your
                            choice wisely when purchasing an RV. Possessing a motorhome or fifth wheel is an
                            achievement of a lifetime. It can be similar to sojourning with your residence as you
                            search the various sites of our great land, America.</p>
                        <p>The two commonly known recreational vehicle classes are the motorized and towable.
                            Towable rvs are the travel trailers and the fifth wheel. The rv travel trailer or fifth
                            wheel has the attraction of getting towed by a pickup or a car, thus giving the
                            adaptability of possessing transportation for you when you are parked at your campsite.
                        </p>
                    </div>
                </div>
                <div class="rd-reviews">
                    <h4>Reviews</h4>
                    <div class="review-item">
                        <div class="ri-pic">
                            <img src="img/room/avatar/avatar-1.jpg" alt="">
                        </div>
                        <div class="ri-text">
                            <span>27 Aug 2019</span>
                            <div class="rating">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star-half_alt"></i>
                            </div>
                            <h5>Brandon Kelley</h5>
                            <p>Neque porro qui squam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                adipisci velit, sed quia non numquam eius modi tempora. incidunt ut labore et dolore
                                magnam.</p>
                        </div>
                    </div>
                    <div class="review-item">
                        <div class="ri-pic">
                            <img src="img/room/avatar/avatar-2.jpg" alt="">
                        </div>
                        <div class="ri-text">
                            <span>27 Aug 2019</span>
                            <div class="rating">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star-half_alt"></i>
                            </div>
                            <h5>Brandon Kelley</h5>
                            <p>Neque porro qui squam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                adipisci velit, sed quia non numquam eius modi tempora. incidunt ut labore et dolore
                                magnam.</p>
                        </div>
                    </div>
                </div>
                <div class="review-add">
                    <h4>Add Review</h4>
                    <form action="#" class="ra-form">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" placeholder="Name*">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" placeholder="Email*">
                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <h5>You Rating:</h5>
                                    <div class="rating">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star-half_alt"></i>
                                    </div>
                                </div>
                                <textarea placeholder="Your Review"></textarea>
                                <button type="submit">Submit Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="room-booking">
                    <h3>Your Reservation</h3>
                    <form action="#" id="reservationForm">
                        <div class="check-date">
                            <label for="date-in">Check In:</label>
                            <input type="text" class="date-input" id="date-in">
                            <i class="icon_calendar"></i>
                        </div>
                        <div class="check-date">
                            <label for="date-out">Check Out:</label>
                            <input type="text" class="date-input" id="date-out">
                            <i class="icon_calendar"></i>
                        </div>
                        <div class="select-option">
                            <label for="guest">Guests:</label>
                            <select id="guest">
                                <option value="1">1 Adults</option>
                                <option value="2">2 Adults</option>
                                <option value="3">3 Adults</option>
                            </select>
                        </div>
                        <div class="select-option">
                            <label for="room">Room:</label>
                            <select id="room">
                                <option value="1">1 Room</option>
                                <option value="2">2 Room</option>
                                <option value="3">3 Room</option>
                            </select>
                        </div>
                        <button type="button" id="whatsappLink">Reservation</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Room Details Section End -->
<script>
    document.getElementById('whatsappLink').addEventListener('click', function () {

        const checkIn = document.getElementById('date-in').value;
        const checkOut = document.getElementById('date-out').value;
        const guest = document.getElementById('guest').value;
        const room = document.getElementById('room').value;

        if (!checkIn || !checkOut || !guest || !room) {
            alert('Mohon lengkapi semua data sebelum melanjutkan.');
            return;
        }

        const message = `Hello, I would like to book a *${room} room* with *${guest} guests*. Check-in: *${checkIn}*, Check-out: *${checkOut}*. Is it available?`;
        const whatsappLink = `https://wa.me/6285536724645/?text=${encodeURIComponent(message)}`;

        window.open(whatsappLink, '_blank');
    });

    const mainImage = document.getElementById("mainImage");
    const thumbnails = document.querySelectorAll(".thumbnail");

    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener("click", function () {
            const currentMainImageSrc = mainImage.src;
            mainImage.src = this.src;
            this.src = currentMainImageSrc;
        });
    });


</script>

@endsection