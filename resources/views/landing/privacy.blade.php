@extends('layouts.appLanding')

@section('title', 'Privacy Policy')

@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Privacy Policy</h2>
                    <div class="bt-option">
                        <a href="{{ route('landing.index') }}"
                            class="{{ request()->routeIs('landing.index') ? 'active' : '' }}">Home</a><span>Privacy
                            Policy</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Privacy Policy Section Begin -->
<section class="privacy-policy-section spad" style="margin-top: -10%;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="privacy-text">
                    <h3>Introduction</h3>
                    <p>Your privacy is important to us at <strong>Hotel Bfashion</strong>. This privacy policy outlines
                        how we collect, use, and protect your personal information when you use our services, including
                        booking rooms, signing up for newsletters, and interacting with our website.</p>

                    <h3>Information We Collect</h3>
                    <p>We collect personal information that you provide to us when booking a room, subscribing to our
                        newsletter, or using our website services. This includes your name, email address, phone number,
                        payment information, and details of your stay.</p>

                    <h3>How We Use Your Information</h3>
                    <p>We use your personal information to process bookings, provide customer support, send promotional
                        materials, and improve our services. Your information may also be used to personalize your
                        experience with us.</p>

                    <h3>Data Security</h3>
                    <p>We implement appropriate security measures to protect your personal data from unauthorized
                        access, disclosure, alteration, or destruction. However, please note that no method of
                        transmission over the internet is completely secure, and we cannot guarantee full security.</p>

                    <h3>Sharing of Information</h3>
                    <p>We do not sell, rent, or trade your personal information to third parties. However, we may share
                        your data with trusted partners who assist in providing services to you, such as payment
                        processors, for the purpose of fulfilling your bookings.</p>

                    <h3>Your Rights</h3>
                    <p>You have the right to access, update, or delete your personal information at any time. If you
                        wish to exercise any of these rights, please contact us through the details provided on our
                        website.</p>

                    <h3>Changes to Privacy Policy</h3>
                    <p>Hotel Bfashion reserves the right to update this Privacy Policy at any time. Any changes will be
                        posted on this page, and the updated policy will take effect immediately upon posting.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Privacy Policy Section End -->
@endsection