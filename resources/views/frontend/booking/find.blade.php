@extends('frontend.layouts.app')

@section('title','Find Booking')

@section('content')

<div class="container py-5">

<div class="card shadow">

<div class="card-header">
<h3>
Find My Booking
</h3>
</div>


<div class="card-body">


@if(session('error'))

<div class="alert alert-danger">
{{ session('error') }}
</div>

@endif


<form method="POST"
      action="{{ route('booking.search') }}">

@csrf


<div class="mb-3">

<label class="form-label">
Booking Reference
</label>

<input type="text"
       name="booking_reference"
       class="form-control"
       placeholder="BF-000001">

</div>


<div class="mb-3">

<label class="form-label">
Email Address
</label>

<input type="email"
       name="email"
       class="form-control">

</div>


<button class="btn btn-primary">
Search Booking
</button>


</form>


</div>

</div>

</div>

@endsection
