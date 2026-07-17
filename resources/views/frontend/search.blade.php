@extends('frontend.layouts.app')

@section('title', 'Available Buses')

@section('content')

<div class="container py-5">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                Available Buses
            </h2>

            <p class="text-muted mb-0">
                {{ $trips->total() }} Bus{{ $trips->total() != 1 ? 'es' : '' }} Found
            </p>

        </div>

        <a href="{{ route('home') }}" class="btn btn-outline-primary">
            Modify Search
        </a>

    </div>

    @forelse($trips as $trip)

        <div class="card shadow-sm border-0 rounded-4 mb-4">

            <div class="card-body p-4">

                <div class="row align-items-center">

                    <!-- Bus Information -->
                    <div class="col-lg-3">

                        <h5 class="fw-bold mb-2">

                            {{ $trip->bus->name }}

                        </h5>

                        <span class="badge bg-success">
                            AC Sleeper
                        </span>

                        <div class="mt-3">

                            ⭐⭐⭐⭐⭐

                            <small class="text-muted">
                                4.8
                            </small>

                        </div>

                    </div>

                    <!-- Route & Time -->
                    <div class="col-lg-5 text-center">

                        <div class="row">

                            <div class="col">

                                <h4 class="fw-bold">

                                    {{ \Carbon\Carbon::parse($trip->departure_time)->format('h:i A') }}

                                </h4>

                                <small class="text-muted">

                                    {{ $trip->busRoute->source_city }}

                                </small>

                            </div>

                            <div class="col">

                                <div class="fw-bold">

                                    →

                                </div>

                                <small class="text-muted">

                                    Direct

                                </small>

                            </div>

                            <div class="col">

                                <h4 class="fw-bold">

                                    {{ \Carbon\Carbon::parse($trip->arrival_time)->format('h:i A') }}

                                </h4>

                                <small class="text-muted">

                                    {{ $trip->busRoute->destination_city }}

                                </small>

                            </div>

                        </div>

                    </div>

                    <!-- Price -->
                    <div class="col-lg-2 text-center">

                        <h3 class="text-primary fw-bold">

                            ₹{{ number_format($trip->fare) }}

                        </h3>

                        <small class="text-muted">

                            Starting Fare

                        </small>

                    </div>

                    <!-- Button -->
                    <div class="col-lg-2 text-end">

                     <a href="{{ route('frontend.seat-selection', $trip) }}"
   class="btn btn-warning">
    Select Seats
</a>

                    </div>

                </div>

            </div>

        </div>

    @empty

        <div class="alert alert-warning">

            No buses found for the selected route.

        </div>

    @endforelse

    <div class="mt-4">

        {{ $trips->links() }}

    </div>

</div>

@endsection
