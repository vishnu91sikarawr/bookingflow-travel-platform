@extends('layouts.app')

@section('content')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
<!-- Hero Section -->

<section class="hero-section">
<div class="hero-overlay">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-10 text-center">

                <h1 class="display-4 fw-bold text-white">
                    Travel Across India
                </h1>

                <p class="lead text-white mb-5">
                    Book bus tickets online with comfort, safety and the best prices.
                    <div class="search-card">

    <form action="{{ route('search') }}" method="GET">

        <div class="row g-3">

            <div class="col-md-3">

                <label class="form-label">
                    From
                </label>

                <select
                    name="from"
                    class="form-select">

                    @foreach($cities as $city)

                        <option value="{{ $city }}">
                            {{ $city }}
                        </option>

                    @endforeach

                </select>

            </div>

            <div class="col-md-3">

                <label class="form-label">
                    To
                </label>

                <select
                    name="to"
                    class="form-select">

                    @foreach($cities as $city)

                        <option value="{{ $city }}">
                            {{ $city }}
                        </option>

                    @endforeach

                </select>

            </div>

            <div class="col-md-3">

                <label class="form-label">
                    Journey Date
                </label>

                <input
                    type="date"
                    name="date"
                    class="form-control">

            </div>

            <div class="col-md-3 d-grid">

                <label>&nbsp;</label>

                <button class="btn btn-warning btn-lg">

                    Search Buses

                </button>

            </div>

        </div>

    </form>

</div>
                </p>

            </div>

        </div>

    </div>

</div>
</section>

<!-- Statistics -->

<section class="stats-section py-5">

    <div class="container">

        <div class="row text-center">

            <div class="col-lg-3 col-6 mb-4">

                <div class="stat-card">

                    <i class="bi bi-bus-front-fill stat-icon"></i>

                    <h2>500+</h2>

                    <p>Bus Operators</p>

                </div>

            </div>

            <div class="col-lg-3 col-6 mb-4">

                <div class="stat-card">

                    <i class="bi bi-geo-alt-fill stat-icon"></i>

                    <h2>2,000+</h2>

                    <p>Routes</p>

                </div>

            </div>

            <div class="col-lg-3 col-6 mb-4">

                <div class="stat-card">

                    <i class="bi bi-people-fill stat-icon"></i>

                    <h2>50K+</h2>

                    <p>Happy Customers</p>

                </div>

            </div>

            <div class="col-lg-3 col-6 mb-4">

                <div class="stat-card">

                    <i class="bi bi-ticket-perforated-fill stat-icon"></i>

                    <h2>1M+</h2>

                    <p>Tickets Booked</p>

                </div>

            </div>

        </div>

    </div>

</section>
<!-- Popular Routes -->

<section class="popular-routes py-5">
<section class="popular-routes py-5 bg-light">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="fw-bold">Popular Routes</h2>

            <p class="text-muted">
                Find buses on India's most travelled routes.
            </p>

        </div>

        <div class="row">

            @php
                $routes = [
                    ['Delhi','Jaipur','₹499'],
                    ['Delhi','Agra','₹399'],
                    ['Mumbai','Pune','₹450'],
                    ['Bengaluru','Mysuru','₹350'],
                    ['Hyderabad','Vijayawada','₹420'],
                    ['Chennai','Coimbatore','₹550']
                ];
            @endphp

            @foreach($routes as $route)

                <div class="col-lg-4 col-md-6 mb-4">

                    <div class="route-card">

                        <h4>{{ $route[0] }}</h4>

                        <div class="my-3">

                            <i class="bi bi-arrow-down fs-4 text-warning"></i>

                        </div>

                        <h4>{{ $route[1] }}</h4>

                        <p class="text-muted">
                            Starting from
                        </p>

                        <h3 class="text-primary">
                            {{ $route[2] }}
                        </h3>

                        <a href="#" class="btn btn-outline-warning mt-3">
                            View Buses
                        </a>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>
</section>

<!-- Why Choose Us -->

<!-- Why Choose Us -->
<section class="why-us py-5">

    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Why Choose BookingFlow?</h2>
            <p class="text-muted">
                We make bus travel simple, secure, and affordable.
            </p>
        </div>

        <div class="row g-4">

            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>

                    <h4>Secure Booking</h4>

                    <p>
                        Your payments and personal information are protected with secure technologies.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-cash-coin"></i>
                    </div>

                    <h4>Best Prices</h4>

                    <p>
                        Compare fares from multiple operators and always find competitive ticket prices.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-headset"></i>
                    </div>

                    <h4>24/7 Support</h4>

                    <p>
                        Our support team is available anytime to help with bookings and travel queries.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>

                    <h4>Wide Coverage</h4>

                    <p>
                        Travel across hundreds of cities with trusted bus operators throughout India.
                    </p>
                </div>
            </div>

        </div>

    </div>

</section>

<section class="cta-section py-5">

    <div class="container">

        <div class="cta-box text-center">

            <h2 class="fw-bold text-white">
                Ready to Book Your Next Journey?
            </h2>

            <p class="text-white-50 mt-3">
                Search buses, compare prices, and reserve your seat in just a few clicks.
            </p>

            <a href="#search" class="btn btn-light btn-lg mt-3">
                Search Buses
            </a>

        </div>

    </div>

</section>

<section class="how-it-works py-5 bg-light">

    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">How BookingFlow Works</h2>
            <p class="text-muted">
                Book your journey in just four simple steps.
            </p>
        </div>

        <div class="row text-center">

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="step-card">
                    <div class="step-icon">
                        <i class="bi bi-search"></i>
                    </div>

                    <h5>Search</h5>

                    <p>
                        Enter your source, destination and travel date.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="step-card">
                    <div class="step-icon">
                        <i class="bi bi-bus-front"></i>
                    </div>

                    <h5>Select Bus</h5>

                    <p>
                        Compare buses, timings and ticket prices.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="step-card">
                    <div class="step-icon">
                        <i class="bi bi-credit-card"></i>
                    </div>

                    <h5>Secure Payment</h5>

                    <p>
                        Complete your booking using a secure payment gateway.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="step-card">
                    <div class="step-icon">
                        <i class="bi bi-ticket-perforated"></i>
                    </div>

                    <h5>Travel</h5>

                    <p>
                        Receive your e-ticket and enjoy your journey.
                    </p>
                </div>
            </div>

        </div>

    </div>

</section>

<section class="testimonials py-5">

    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">What Our Customers Say</h2>
            <p class="text-muted">
                Thousands of travelers trust BookingFlow for their journeys.
            </p>
        </div>

        <div class="row">

            <div class="col-lg-4 mb-4">

                <div class="testimonial-card">

                    <div class="stars mb-3">
                        ⭐⭐⭐⭐⭐
                    </div>

                    <p>
                        BookingFlow made my trip effortless. The booking process was fast and the journey was comfortable.
                    </p>

                    <div class="d-flex align-items-center mt-4">

                        <img src="https://i.pravatar.cc/60?img=5"
                             class="rounded-circle me-3"
                             width="60">

                        <div>

                            <strong>Rahul Sharma</strong>

                            <div class="text-muted">
                                Delhi
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Duplicate this card two more times -->
        </div>

    </div>

</section>

@endsection
