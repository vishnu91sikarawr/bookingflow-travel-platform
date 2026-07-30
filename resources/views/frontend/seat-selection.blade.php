@extends('frontend.layouts.app')

@section('title', 'Seat Selection')

@section('content')

<section class="py-5">

    <div class="container">

        <!-- Breadcrumb -->
        <nav class="mb-4">

            <a href="{{ route('home') }}">
                Home
            </a>

            /

            <a href="{{ route('search') }}">
                Bus List
            </a>

            /

            Seat Selection

        </nav>


        <!-- Trip Card -->
        <div class="card shadow-sm border-0 rounded-4 mb-4">

            <div class="card-body">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <h3 class="fw-bold">
                            {{ $trip->bus->name }}
                        </h3>

                        <p class="mb-1">

                            {{ $trip->busRoute->source_city }}

                            →

                            {{ $trip->busRoute->destination_city }}

                        </p>

                        <small class="text-muted">

                            Departure:

                            {{ \Carbon\Carbon::parse($trip->departure_time)->format('d M Y, h:i A') }}

                        </small>

                    </div>


                    <div class="col-md-4 text-end">

                        <h3 class="text-primary">

                            ₹{{ number_format($trip->fare) }}

                        </h3>

                        <small>
                            Per Seat
                        </small>

                    </div>

                </div>

            </div>

        </div>


        <!-- Vue Seat Selection -->

      <div
    id="app"
    data-trip-id="{{ $trip->id }}"
    data-fare="{{ $trip->fare }}"
>
</div>

    </div>

</section>

@endsection
