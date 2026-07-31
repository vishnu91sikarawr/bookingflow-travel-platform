@extends('frontend.layouts.app')

@section('title', 'Payment')

@section('content')

<div class="container py-5">

    <div class="card shadow">

        <div class="card-header">
            <h3>Payment</h3>
        </div>


        <div class="card-body text-center">

            <h5>
                Booking ID: #{{ $booking->id }}
            </h5>

            <p class="mt-3">
                Amount:
                ₹{{ number_format($booking->total_amount,2) }}
            </p>


            <form method="POST"
                  action="{{ route('booking.payment-success',$booking) }}">

                @csrf

                <button class="btn btn-success btn-lg">
                    Pay Now (Demo)
                </button>

            </form>


        </div>

    </div>

</div>

@endsection
