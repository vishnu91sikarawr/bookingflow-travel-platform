@extends('frontend.layouts.app')

@section('title','Booking Confirmed')


@section('content')

<div class="container py-5">

<div class="card shadow text-center">

<div class="card-body p-5">


<h1 class="text-success mb-3">
    ✅ Booking Confirmed
</h1>


<h4 class="mb-4">
    Thank you for booking with BookingFlow
</h4>


<div class="alert alert-primary">

    Booking Reference

    <h3>
        BF-{{ str_pad($booking->id,6,'0',STR_PAD_LEFT) }}
    </h3>

</div>


<hr>


<p>
<strong>Route:</strong>

{{ $booking->trip->busRoute->source_city }}

→

{{ $booking->trip->busRoute->destination_city }}

</p>


<p>

<strong>Seats:</strong>

{{ $booking->passengers->pluck('seat_number')->implode(', ') }}

</p>


<p>

<strong>Total Amount:</strong>

₹{{ number_format($booking->total_amount,2) }}

</p>


<hr>


<div class="d-flex justify-content-center gap-3">


<a href="{{ route('booking.ticket',$booking) }}"
   class="btn btn-success">

    Download Ticket

</a>



@if(auth()->check())

<a href="{{ route('my-bookings') }}"
   class="btn btn-primary">

    My Bookings

</a>


@else


<a href="{{ route('booking.find') }}"
   class="btn btn-primary">

    Find My Booking

</a>


@endif


</div>


</div>

</div>

</div>

@endsection
