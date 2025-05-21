@extends('layouts.appLanding')

@section('title', 'Terms of Use')

@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Terms of Use</h2>
                    <div class="bt-option">
                        <a href="{{ route('landing.index') }}"
                            class="{{ request()->routeIs('landing.index') ? 'active' : '' }}">Home</a><span>Terms of
                            Use</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Terms of Use Section Begin -->
<section class="terms-of-use-section spad" style="margin-top: -10%;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="terms-text">
                    <h3>Introduction</h3>
                    <p>Welcome to <strong>Hotel Bfashion</strong>, a luxury brand dedicated to providing you with
                        unforgettable experiences and world-class service. By using our services, you agree to the
                        following terms and conditions.</p>

                    <h3>Use of Services</h3>
                    <p>Our services are available to individuals 18 years and older. You agree to use our website,
                        booking services, and other offerings only for lawful purposes. Any misuse of our services,
                        including but not limited to illegal activity, will result in immediate termination of access.
                    </p>

                    <h3>Reservations & Payments</h3>
                    <p>All bookings made through our website require valid credit card information. Payments for
                        services are due at the time of booking unless specified otherwise. Cancellations and
                        modifications are subject to the conditions outlined at the time of reservation.</p>

                    <h3>Intellectual Property</h3>
                    <p>The content of our website, including text, images, logos, and other materials, is the property
                        of Hotel Bfashion. Unauthorized use or reproduction of any content without our express
                        permission is prohibited.</p>

                    <h3>Limitation of Liability</h3>
                    <p>Hotel Bfashion is not liable for any damages or losses incurred as a result of using our website
                        or services, except where liability is mandated by law. This includes, but is not limited to,
                        errors in booking, lost reservations, or disruptions caused by third parties.</p>

                    <h3>Changes to Terms</h3>
                    <p>Hotel Bfashion reserves the right to update these Terms of Use at any time. Any changes will be
                        posted on this page, and the updated terms will take effect immediately upon posting.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Terms of Use Section End -->
@endsection