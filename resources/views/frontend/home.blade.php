@extends('frontend.layouts.app')
@section('content')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
<!-- =========================================================
     HERO / SEARCH
========================================================= -->


<section
    class="hero-section"
    style="background-image: url('{{ asset('images/hero-bus.png') }}');"
>

    <div class="hero-overlay">

        <div class="container">

            <div class="hero-content">

                <div class="text-center text-white mb-4">

                    <span class="hero-badge">
                        <i class="bi bi-bus-front-fill me-1"></i>
                        India's Bus Booking Platform
                    </span>

                    <h1 class="display-4 fw-bold mt-3 mb-3">
                        Travel Across India
                    </h1>

                    <p class="lead mb-0">
                        Find buses, compare fares and book your seat
                        with confidence.
                    </p>

                </div>


                <!-- SEARCH CARD -->

                <div class="search-card" id="search">

                    <div class="search-card-header">

                        <h4 class="fw-bold mb-1">
                            Search Buses
                        </h4>

                        <p class="text-muted mb-0">
                            Find the best bus for your journey
                        </p>

                    </div>


                    <form
                        action="{{ route('search') }}"
                        method="GET"
                    >

                        <div class="row g-3 align-items-end">

                            <!-- FROM -->

                            <div class="col-lg-3 col-md-6">

                                <label class="form-label fw-semibold">
                                    From
                                </label>

                                <div class="search-input-wrapper">

                                    <i class="bi bi-geo-alt"></i>

                                    <select
                                        name="from"
                                        class="form-select search-input"
                                        required
                                    >

                                        <option value="">
                                            Select departure city
                                        </option>

                                        @foreach($cities as $city)

                                            <option value="{{ $city }}">
                                                {{ $city }}
                                            </option>

                                        @endforeach

                                    </select>

                                </div>

                            </div>


                            <!-- TO -->

                            <div class="col-lg-3 col-md-6">

                                <label class="form-label fw-semibold">
                                    To
                                </label>

                                <div class="search-input-wrapper">

                                    <i class="bi bi-geo-alt-fill"></i>

                                    <select
                                        name="to"
                                        class="form-select search-input"
                                        required
                                    >

                                        <option value="">
                                            Select destination
                                        </option>

                                        @foreach($cities as $city)

                                            <option value="{{ $city }}">
                                                {{ $city }}
                                            </option>

                                        @endforeach

                                    </select>

                                </div>

                            </div>


                            <!-- DATE -->

                            <div class="col-lg-3 col-md-6">

                                <label class="form-label fw-semibold">
                                    Journey Date
                                </label>

                                <div class="search-input-wrapper">

                                    <i class="bi bi-calendar3"></i>

                                    <input
                                        type="date"
                                        name="date"
                                        class="form-control search-input"
                                        min="{{ date('Y-m-d') }}"
                                        required
                                    >

                                </div>

                            </div>


                            <!-- BUTTON -->

                            <div class="col-lg-3 col-md-6">

                                <button
                                    type="submit"
                                    class="btn btn-primary btn-lg w-100 search-button"
                                >

                                    <i class="bi bi-search me-2"></i>

                                    Search Buses

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>
<!-- =========================================================
     STATISTICS
========================================================= -->

<section class="stats-section">

    <div class="container">

        <div class="row g-4">

            <div class="col-lg-3 col-6">

                <div class="stat-card">

                    <div class="stat-icon">
                        <i class="bi bi-bus-front-fill"></i>
                    </div>

                    <h3>
                        500+
                    </h3>

                    <p>
                        Bus Operators
                    </p>

                </div>

            </div>


            <div class="col-lg-3 col-6">

                <div class="stat-card">

                    <div class="stat-icon">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>

                    <h3>
                        2,000+
                    </h3>

                    <p>
                        Routes
                    </p>

                </div>

            </div>


            <div class="col-lg-3 col-6">

                <div class="stat-card">

                    <div class="stat-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>

                    <h3>
                        50K+
                    </h3>

                    <p>
                        Happy Customers
                    </p>

                </div>

            </div>


            <div class="col-lg-3 col-6">

                <div class="stat-card">

                    <div class="stat-icon">
                        <i class="bi bi-ticket-perforated-fill"></i>
                    </div>

                    <h3>
                        1M+
                    </h3>

                    <p>
                        Tickets Booked
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- =========================================================
     POPULAR ROUTES
========================================================= -->

<section class="popular-routes py-5 bg-light">

    <div class="container">

        <div class="section-heading text-center mb-5">

            <span class="section-label">
                Explore Routes
            </span>

            <h2 class="fw-bold mt-2">
                Popular Routes
            </h2>

            <p class="text-muted mb-0">
                Discover popular destinations across India.
            </p>

        </div>


        @php

            $routes = [

                [
                    'from' => 'Delhi',
                    'to' => 'Jaipur',
                    'fare' => '₹499'
                ],

                [
                    'from' => 'Delhi',
                    'to' => 'Agra',
                    'fare' => '₹399'
                ],

                [
                    'from' => 'Mumbai',
                    'to' => 'Pune',
                    'fare' => '₹450'
                ],

                [
                    'from' => 'Bengaluru',
                    'to' => 'Mysuru',
                    'fare' => '₹350'
                ],

                [
                    'from' => 'Hyderabad',
                    'to' => 'Vijayawada',
                    'fare' => '₹420'
                ],

                [
                    'from' => 'Chennai',
                    'to' => 'Coimbatore',
                    'fare' => '₹550'
                ]

            ];

        @endphp


        <div class="row g-4">

            @foreach($routes as $route)

                <div class="col-lg-4 col-md-6">

                    <div class="route-card h-100">

                        <div class="route-icon">

                            <i class="bi bi-bus-front"></i>

                        </div>


                        <div class="route-cities">

                            <div>
                                <span class="text-muted small">
                                    From
                                </span>

                                <h5 class="fw-bold mb-0">
                                    {{ $route['from'] }}
                                </h5>
                            </div>


                            <div class="route-arrow">

                                <i class="bi bi-arrow-right"></i>

                            </div>


                            <div class="text-end">

                                <span class="text-muted small">
                                    To
                                </span>

                                <h5 class="fw-bold mb-0">
                                    {{ $route['to'] }}
                                </h5>

                            </div>

                        </div>


                        <div class="route-footer">

                            <div>

                                <small class="text-muted d-block">
                                    Starting from
                                </small>

                                <strong class="text-primary fs-5">
                                    {{ $route['fare'] }}
                                </strong>

                            </div>


                            <a
                                href="{{ route('home') }}#search"
                                class="btn btn-outline-primary btn-sm"
                            >
                                Search
                            </a>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>


<!-- =========================================================
     WHY CHOOSE US
========================================================= -->

<section class="why-us py-5">

    <div class="container">

        <div class="section-heading text-center mb-5">

            <span class="section-label">
                Why BookingFlow
            </span>

            <h2 class="fw-bold mt-2">
                Everything You Need for a Better Journey
            </h2>

            <p class="text-muted mb-0">
                Simple booking, transparent pricing and a secure experience.
            </p>

        </div>


        <div class="row g-4">

            <div class="col-lg-3 col-md-6">

                <div class="feature-card h-100">

                    <div class="feature-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>

                    <h5 class="fw-bold">
                        Secure Booking
                    </h5>

                    <p>
                        Your booking and personal information are protected
                        using secure technologies.
                    </p>

                </div>

            </div>


            <div class="col-lg-3 col-md-6">

                <div class="feature-card h-100">

                    <div class="feature-icon">
                        <i class="bi bi-cash-coin"></i>
                    </div>

                    <h5 class="fw-bold">
                        Best Prices
                    </h5>

                    <p>
                        Compare fares and choose a trip that fits your
                        budget.
                    </p>

                </div>

            </div>


            <div class="col-lg-3 col-md-6">

                <div class="feature-card h-100">

                    <div class="feature-icon">
                        <i class="bi bi-headset"></i>
                    </div>

                    <h5 class="fw-bold">
                        Helpful Support
                    </h5>

                    <p>
                        Get assistance whenever you need help with your
                        booking or journey.
                    </p>

                </div>

            </div>


            <div class="col-lg-3 col-md-6">

                <div class="feature-card h-100">

                    <div class="feature-icon">
                        <i class="bi bi-map"></i>
                    </div>

                    <h5 class="fw-bold">
                        Wide Coverage
                    </h5>

                    <p>
                        Discover routes and destinations across cities
                        throughout India.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- =========================================================
     HOW IT WORKS
========================================================= -->

<section class="how-it-works py-5 bg-light">

    <div class="container">

        <div class="section-heading text-center mb-5">

            <span class="section-label">
                Simple Process
            </span>

            <h2 class="fw-bold mt-2">
                How BookingFlow Works
            </h2>

            <p class="text-muted mb-0">
                Book your journey in four simple steps.
            </p>

        </div>


        <div class="row g-4">

            <div class="col-lg-3 col-md-6">

                <div class="step-card h-100">

                    <div class="step-number">
                        01
                    </div>

                    <div class="step-icon">
                        <i class="bi bi-search"></i>
                    </div>

                    <h5 class="fw-bold">
                        Search
                    </h5>

                    <p>
                        Enter your departure city, destination and travel date.
                    </p>

                </div>

            </div>


            <div class="col-lg-3 col-md-6">

                <div class="step-card h-100">

                    <div class="step-number">
                        02
                    </div>

                    <div class="step-icon">
                        <i class="bi bi-bus-front"></i>
                    </div>

                    <h5 class="fw-bold">
                        Select Bus
                    </h5>

                    <p>
                        Compare available buses, timings and fares.
                    </p>

                </div>

            </div>


            <div class="col-lg-3 col-md-6">

                <div class="step-card h-100">

                    <div class="step-number">
                        03
                    </div>

                    <div class="step-icon">
                        <i class="bi bi-credit-card"></i>
                    </div>

                    <h5 class="fw-bold">
                        Complete Booking
                    </h5>

                    <p>
                        Select your seats and provide passenger details.
                    </p>

                </div>

            </div>


            <div class="col-lg-3 col-md-6">

                <div class="step-card h-100">

                    <div class="step-number">
                        04
                    </div>

                    <div class="step-icon">
                        <i class="bi bi-ticket-perforated"></i>
                    </div>

                    <h5 class="fw-bold">
                        Travel
                    </h5>

                    <p>
                        Receive your booking confirmation and enjoy your trip.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- =========================================================
     TESTIMONIALS
========================================================= -->

<section class="testimonials py-5">

    <div class="container">

        <div class="section-heading text-center mb-5">

            <span class="section-label">
                Customer Reviews
            </span>

            <h2 class="fw-bold mt-2">
                What Travelers Say
            </h2>

            <p class="text-muted mb-0">
                A simple booking experience makes every journey better.
            </p>

        </div>


        <div class="row g-4">


            <!-- Testimonial 1 -->

            <div class="col-lg-4">

                <div class="testimonial-card h-100">

                    <div class="stars mb-3">
                        ★★★★★
                    </div>

                    <p>
                        “The booking process was simple and quick.
                        I found my bus and selected my seat without any
                        confusion.”
                    </p>

                    <div class="testimonial-user">

                        <div class="avatar">
                            RS
                        </div>

                        <div>

                            <strong>
                                Rahul Sharma
                            </strong>

                            <small>
                                Delhi
                            </small>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Testimonial 2 -->

            <div class="col-lg-4">

                <div class="testimonial-card h-100">

                    <div class="stars mb-3">
                        ★★★★★
                    </div>

                    <p>
                        “The interface is clean and finding the right
                        trip was very easy. The seat selection was
                        especially helpful.”
                    </p>

                    <div class="testimonial-user">

                        <div class="avatar">
                            AP
                        </div>

                        <div>

                            <strong>
                                Ananya Patel
                            </strong>

                            <small>
                                Mumbai
                            </small>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Testimonial 3 -->

            <div class="col-lg-4">

                <div class="testimonial-card h-100">

                    <div class="stars mb-3">
                        ★★★★★
                    </div>

                    <p>
                        “I could compare buses and fares quickly.
                        BookingFlow makes planning a bus journey much
                        easier.”
                    </p>

                    <div class="testimonial-user">

                        <div class="avatar">
                            VK
                        </div>

                        <div>

                            <strong>
                                Vikram Kumar
                            </strong>

                            <small>
                                Bengaluru
                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- =========================================================
     CTA
========================================================= -->

<section class="cta-section py-5">

    <div class="container">

        <div class="cta-box">

            <div>

                <span class="text-white-50 small">
                    READY FOR YOUR NEXT JOURNEY?
                </span>

                <h2 class="fw-bold text-white mt-2 mb-2">
                    Find Your Bus and Book Your Seat
                </h2>

                <p class="text-white-50 mb-0">
                    Compare routes, choose your bus and travel with confidence.
                </p>

            </div>


            <a
                href="#search"
                class="btn btn-light btn-lg px-4"
            >
                <i class="bi bi-search me-2"></i>
                Search Buses
            </a>

        </div>

    </div>

</section>

@endsection
