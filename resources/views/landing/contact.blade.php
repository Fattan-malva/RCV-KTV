@extends('layouts.appLanding')

@section('title', 'Contact')

@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Contact</h2>
                    <div class="bt-option">
                        <a href="{{ route('landing.index') }}"
                            class="{{ request()->routeIs('landing.index') ? 'active' : '' }}">Home</a><span>Contact</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->
<!-- Contact Section Begin -->
<section class="contact-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="contact-text">
                    <h2>Contact Info</h2>
                    <p>Looking to book a stay or have questions about our services? We're here to assist you!</p>
                    <table>
                        <tbody>
                            <tr>
                                <td class="c-o">Address:</td>
                                <td>Jl. Aranda No.1, Kota Jakarta Barat, DKI Jakarta 11470</td>
                            </tr>
                            <tr>
                                <td class="c-o">Phone:</td>
                                <td>(021) 29666777</td>
                            </tr>
                            <tr>
                                <td class="c-o">Email:</td>
                                <td>reservation@bfashion.co.id</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-7 offset-lg-1">
                <form action="#" class="contact-form">
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="text" placeholder="Your Name">
                        </div>
                        <div class="col-lg-6">
                            <input type="text" placeholder="Your Email">
                        </div>
                        <div class="col-lg-12">
                            <textarea placeholder="Your Message"></textarea>
                            <button type="submit">Submit Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="map">
            <iframe src="https://www.google.com/maps?q=-6.1818713,106.7920374&hl=es;z=14&amp;output=embed" width="600"
                height="470" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>

        </div>
    </div>
</section>
<!-- Contact Section End -->
@endsection