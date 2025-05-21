@extends('layouts.appLanding')

@section('title', 'Environmental Policy')

@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Environmental Policy</h2>
                    <div class="bt-option">
                        <a href="{{ route('landing.index') }}"
                            class="{{ request()->routeIs('landing.index') ? 'active' : '' }}">Home</a><span>Environmental
                            Policy</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Environmental Policy Section Begin -->
<section class="environmental-policy-section spad" style="margin-top: -10%;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="environmental-text">
                    <h3>Our Commitment</h3>
                    <p>At <strong>Hotel Bfashion</strong>, we are committed to reducing our environmental footprint and
                        promoting sustainability. Our goal is to create an eco-friendly environment where our guests can
                        enjoy a luxurious stay while respecting the planet.</p>

                    <h3>Energy Efficiency</h3>
                    <p>We strive to reduce energy consumption throughout our hotel operations. This includes using
                        energy-efficient lighting, implementing smart climate controls, and promoting green building
                        initiatives to reduce our carbon footprint.</p>

                    <h3>Water Conservation</h3>
                    <p>Our hotel uses water-saving technologies to reduce water waste, such as low-flow faucets,
                        toilets, and showerheads. We also encourage our guests to participate in our water conservation
                        efforts by opting for linen and towel reuse during their stay.</p>

                    <h3>Waste Management</h3>
                    <p>We actively recycle and minimize waste generated from our operations. Our team sorts waste into
                        appropriate categories for recycling, and we work with partners who ensure that our waste is
                        disposed of responsibly.</p>

                    <h3>Supporting Sustainable Suppliers</h3>
                    <p>We collaborate with suppliers who share our commitment to sustainability. From eco-friendly
                        cleaning products to sustainable materials for our furnishings, we prioritize vendors who
                        demonstrate a strong environmental consciousness.</p>

                    <h3>Employee Education</h3>
                    <p>We train our staff to understand and practice sustainability principles in their daily work. Our
                        employees are educated on the importance of environmental responsibility and are encouraged to
                        contribute ideas to improve our sustainability efforts.</p>

                    <h3>Continuous Improvement</h3>
                    <p>Hotel Bfashion is dedicated to continuous improvement in our environmental practices. We
                        regularly review and update our policies to ensure we are meeting industry standards and pushing
                        for greater sustainability in the future.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Environmental Policy Section End -->
@endsection