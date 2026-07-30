@extends('frontend.layouts.app')

@section('title','Review Booking')

@section('content')

<div class="container py-5">

    <h2 class="mb-4">Review Booking</h2>

    <div class="card">
            @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
        <div class="card-body">

            <h5>Selected Seats</h5>

            <p>{{ implode(', ', $booking['seats']) }}</p>

            <hr>

            <h5>Passengers</h5>

            @foreach($booking['passengers'] as $passenger)

                <p>
                    {{ $passenger['name'] }}
                    |
                    {{ $passenger['age'] }}
                    |
                    {{ ucfirst($passenger['gender']) }}
                </p>

            @endforeach

            <hr>

            <h5>Total Fare</h5>

            <h3>₹{{ number_format($totalFare,2) }}</h3>

            <button class="btn btn-success mt-3">
                Proceed to Payment
            </button>

        </div>

    </div>

</div>

@endsection
