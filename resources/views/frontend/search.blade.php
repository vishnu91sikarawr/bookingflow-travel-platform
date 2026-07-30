@extends('frontend.layouts.app')

@section('title', 'Available Buses')

@section('content')
<link href="{{ asset('css/search.css') }}" rel="stylesheet">
<div class="container py-5 search-results-page">

    {{-- =========================================================
        Search Result Header
    ========================================================== --}}

   <div class="row align-items-center mb-4 search-result-header">

        <div class="col-md-8">

            <div class="d-flex align-items-center gap-2 mb-2">

                <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                    Bus Search
                </span>

            </div>

            <h2 class="fw-bold mb-1">
                Available Buses
            </h2>

            <p class="text-muted mb-0">
                {{ $trips->total() }}
                {{ $trips->total() != 1 ? 'buses' : 'bus' }}
                available for your journey
            </p>

        </div>

        <div class="col-md-4 text-md-end mt-3 mt-md-0">

            <a
                href="{{ route('home') }}"
                class="btn btn-outline-primary rounded-3 px-4"
            >
                <i class="bi bi-arrow-left me-1"></i>
                Modify Search
            </a>

        </div>

    </div>


    {{-- =========================================================
        Search Result Cards
    ========================================================== --}}

    @forelse($trips as $trip)

       <div class="card bus-result-card shadow-sm mb-4">

            <div class="card-body p-4">

                <div class="row align-items-center g-4">


                    {{-- =================================================
                        Bus Information
                    ================================================== --}}

                    <div class="col-lg-3">

                        <div class="d-flex align-items-start gap-3">

                            <div class="bus-icon">
                                <i class="bi bi-bus-front fs-4"></i>
                            </div>

                            <div>

                                <h5 class="bus-name mb-1">
                                    {{ $trip->bus->name }}
                                </h5>

                                <div class="small text-muted mb-2">
                                    {{ $trip->busRoute->source_city }}
                                    →
                                    {{ $trip->busRoute->destination_city }}
                                </div>

                                <span class="badge bg-success-subtle text-success rounded-pill">
                                    AC Sleeper
                                </span>

                            </div>

                        </div>


                        {{-- Rating --}}

                        <div class="mt-3 small">

                            <span class="text-warning">
                                ★★★★★
                            </span>

                            <span class="fw-semibold ms-1">
                                4.8
                            </span>

                            <span class="text-muted">
                                · Excellent
                            </span>

                        </div>

                    </div>


                    {{-- =================================================
                        Route & Timing
                    ================================================== --}}

                    <div class="col-lg-5">

                        <div class="row align-items-center text-center">

                            {{-- Departure --}}

                            <div class="col-4">

                                <div class="fw-bold fs-4">

                                    {{ \Carbon\Carbon::parse($trip->departure_time)->format('h:i A') }}

                                </div>

                                <div class="small text-muted mt-1">

                                    {{ $trip->busRoute->source_city }}

                                </div>

                            </div>


                            {{-- Journey --}}

                            <div class="col-4">

                                <div class="position-relative">

                                    <div
                                        class="border-top border-2"
                                        style="margin-top: 14px;"
                                    ></div>

                                    <span
                                        class="position-absolute top-50 start-50 translate-middle bg-white px-2 text-primary"
                                    >
                                        <i class="bi bi-arrow-right"></i>
                                    </span>

                                </div>

                                <div class="small text-muted mt-3">
                                    Direct
                                </div>

                            </div>


                            {{-- Arrival --}}

                            <div class="col-4">

                                <div class="fw-bold fs-4">

                                    {{ \Carbon\Carbon::parse($trip->arrival_time)->format('h:i A') }}

                                </div>

                                <div class="small text-muted mt-1">

                                    {{ $trip->busRoute->destination_city }}

                                </div>

                            </div>

                        </div>


                        {{-- Features --}}

                       <div class="bus-features d-flex flex-wrap gap-3">

                            <span class="bus-feature">
                            <i class="bi bi-snow"></i>
                            AC
                            </span>

                            <span class="bus-feature">
                                <i class="bi bi-wifi me-1"></i>
                                WiFi
                            </span>

                            <span class="bus-feature">
                                <i class="bi bi-lightning-charge me-1"></i>
                                Charging
                            </span>

                            <span class="bus-feature">
                                <i class="bi bi-cup-hot me-1"></i>
                                Water Bottle
                            </span>

                        </div>

                    </div>


                    {{-- =================================================
                        Fare
                    ================================================== --}}

                        <div class="fare-label">
                        Starting from
                        </div>

                        <div class="fare-price">
                        ₹{{ number_format($trip->fare) }}
                        </div>

                        <div class="fare-per-seat">
                        per seat
                        </div>


                    {{-- =================================================
                        CTA
                    ================================================== --}}

                    <div class="col-lg-2 text-lg-end">

                        <a
                            href="{{ route('frontend.seat-selection', $trip) }}"
                            class="btn btn-primary select-seat-btn w-100"
                        >
                            Select Seats
                            <i class="bi bi-arrow-right ms-1"></i>
                        </a>

                        <div class="small text-muted mt-2">
                            Secure booking
                        </div>

                    </div>

                </div>

            </div>

        </div>

    @empty


        {{-- =========================================================
            Empty State
        ========================================================== --}}

        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-body text-center py-5">

                <div
                    class="bg-warning-subtle text-warning rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                    style="width: 64px; height: 64px;"
                >
                    <i class="bi bi-bus-front fs-3"></i>
                </div>

                <h4 class="fw-bold">
                    No buses found
                </h4>

                <p class="text-muted mb-4">
                    We couldn't find any buses for the selected route.
                    Try changing your travel date or destination.
                </p>

                <a
                    href="{{ route('home') }}"
                    class="btn btn-primary px-4 rounded-3"
                >
                    Modify Search
                </a>

            </div>

        </div>

    @endforelse


    {{-- =========================================================
        Pagination
    ========================================================== --}}

    @if($trips->hasPages())

        <div class="d-flex justify-content-center mt-4">

            {{ $trips->links() }}

        </div>

    @endif

</div>

@endsection
