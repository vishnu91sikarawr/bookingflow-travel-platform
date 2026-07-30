@extends('frontend.layouts.app')

@section('title', 'Booking Confirmation')

@section('content')

<div class="container py-5">

    <div class="card shadow-sm text-center">

        <div class="card-body">

            <h2 class="text-success">
                🎉 Booking Confirmed
            </h2>

            <p class="mt-3">
                Booking Number:
                <strong>{{ $booking->booking_number }}</strong>
            </p>

            <p>
                Total Amount:
                ₹{{ number_format($booking->total_amount, 2) }}
            </p>

            <a href="{{ route('home') }}" class="btn btn-primary">
                Back to Home
            </a>

        </div>

    </div>

</div>

@endsection
