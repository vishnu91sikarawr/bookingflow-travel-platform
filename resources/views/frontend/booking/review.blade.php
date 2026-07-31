@extends('frontend.layouts.app')

@section('title', 'Review Booking')

@section('content')

<div class="container py-5">

    <div class="card shadow">

        <div class="card-header">
            <h3>Review Booking</h3>
        </div>

        <div class="card-body">

            <h5>Trip Information</h5>

            <table class="table">

                <tr>
                    <th>Route</th>
                    <td>
                        {{ $trip->busRoute->source }}
                        →
                        {{ $trip->busRoute->destination }}
                    </td>
                </tr>

                <tr>
                    <th>Date</th>
                    <td>{{ $trip->departure_date }}</td>
                </tr>

                <tr>
                    <th>Departure</th>
                    <td>{{ $trip->departure_time }}</td>
                </tr>

                <tr>
                    <th>Seats</th>
                    <td>{{ implode(', ', $seats) }}</td>
                </tr>

                <tr>
                    <th>Total Fare</th>
                    <td>₹{{ number_format($totalFare, 2) }}</td>
                </tr>

            </table>

            <hr>
            <h5 class="mt-4">Contact Information</h5>

<table class="table">

    <tr>
        <th>Name</th>
        <td>{{ $contactName }}</td>
    </tr>

    <tr>
        <th>Email</th>
        <td>{{ $contactEmail }}</td>
    </tr>

    <tr>
        <th>Phone</th>
        <td>{{ $contactPhone }}</td>
    </tr>

</table>
<hr>

            <h5>Passengers</h5>

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Seat</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($passengers as $index => $passenger)

                    <tr>

                        <td>{{ $passenger['name'] }}</td>

                        <td>{{ $passenger['age'] }}</td>

                        <td>{{ ucfirst($passenger['gender']) }}</td>

                        <td>{{ $seats[$index] }}</td>

                    </tr>

                @endforeach

                </tbody>

            </table>

           <form method="POST" action="{{ route('booking.process-payment') }}">
             @csrf
              <input type="hidden" name="trip_id" value="{{ $trip->id }}">
            <input type="hidden" name="contact_name" value="{{ $contactName }}">
            <input type="hidden" name="contact_email" value="{{ $contactEmail }}">
            <input type="hidden" name="contact_phone" value="{{ $contactPhone }}">


                @foreach($passengers as $index => $passenger)

                    <input type="hidden" name="passengers[{{ $index }}][name]" value="{{ $passenger['name'] }}">
                    <input type="hidden" name="passengers[{{ $index }}][age]" value="{{ $passenger['age'] }}">
                    <input type="hidden" name="passengers[{{ $index }}][gender]" value="{{ $passenger['gender'] }}">

                @endforeach

                @foreach($seats as $seat)

                    <input type="hidden" name="seats[]" value="{{ $seat }}">

                @endforeach

                <div class="d-flex justify-content-between">

                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        Back
                    </a>

                    <button class="btn btn-success">
                        Confirm Booking
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
