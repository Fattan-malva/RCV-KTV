@extends('layouts.appAdmin')
@section('header_title', 'Dashboard')
@section('content')
<style>
    .card {
        padding: 50px;
        border: none;
        box-shadow: rgb(230,231,235) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
    }

    .small {
        padding: 20px 20px;
        box-shadow: rgb(230,231,235) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
        margin-right: 35px;
    }

    /* Styling for portrait cards */
    .portrait-card {
        height: 400px;
        box-shadow: rgb(230,231,235) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
        padding: 15px;
        text-align: center;
    }
</style>

<div class="row">
    <div class="col-md-8">
        <div class="card p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h1>Welcome to Admin Dashboard</h1>
                    <p>This is the main content area.</p>
                </div>
                <img src="{{ asset('img/fotoadmin.png') }}" alt="Image" class="img-fluid" style="max-width: 150px;" />
            </div>
        </div>
        <div class="card p-4 mt-4">
            <div class="d-flex align-items-center justify-content-between" style="padding-bottom:170px;">
                <div>
                    <h1>Content Premier</h1>
                    <p>This is the main content area.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card small mb-4">
            <h5>Small Card 1</h5>
            <p>Content for small card 1.</p>
        </div>
        <div class="card small mb-4">
            <h5>Small Card 2</h5>
            <p>Content for small card 2.</p>
        </div>
        <div class="card small mb-4">
            <h5>Small Card 3</h5>
            <p>Content for small card 3.</p>
        </div>
        <div class="card small">
            <h5>Small Card 4</h5>
            <p>Content for small card 4.</p>
        </div>
    </div>
</div>

<!-- Row for Portrait Cards -->
<div class="row mt-4">
    <div class="col-md-4">
        <div class="card portrait-card">
            <h5>Portrait 1</h5>
            <p>Content for portrait 1.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card portrait-card">
            <h5>Portrait 2</h5>
            <p>Content for portrait 2.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card portrait-card" style="margin-right:35px;">
            <h5>Portrait 3</h5>
            <p>Content for portrait 3.</p>
        </div>
    </div>
</div>
@endsection
