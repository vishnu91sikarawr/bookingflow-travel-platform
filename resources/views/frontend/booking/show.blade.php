@extends('frontend.layouts.app')

@section('title', 'Booking Details')

@section('content')

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="mb-0">
            Booking #BF-{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}
        </h2>

        <a href="{{ route('my-bookings') }}" class="btn btn-outline-secondary">
            ← Back to My Bookings
        </a>

    </div>

    <div class="row">

        <!-- Left Column -->
        <div class="col-lg-8">

            <!-- Trip Details -->
            <div class="card shadow-sm mb-4">

                <div class="card-header">
                    <h5 class="mb-0">Trip Information</h5>
                </div>

                <div class="card-body">

                    <table class="table table-borderless mb-0">

                        <tr>
                            <th width="180">Bus</th>
                            <td>{{ $booking->trip->bus->name }}</td>
                        </tr>

                        <tr>
                            <th>Route</th>
                            <td>
                                {{ $booking->trip->busRoute->source_city }}
                                →
                                {{ $booking->trip->busRoute->destination_city }}
                            </td>
                        </tr>

                        <tr>
                            <th>Departure Date</th>
                            <td>{{ \Carbon\Carbon::parse($booking->trip->departure_date)->format('d M Y') }}</td>
                        </tr>

                        <tr>
                            <th>Departure Time</th>
                            <td>{{ \Carbon\Carbon::parse($booking->trip->departure_time)->format('h:i A') }}</td>
                        </tr>

                    </table>

                </div>

            </div>

            <!-- Passenger Details -->
            <div class="card shadow-sm mb-4">

                <div class="card-header">
                    <h5 class="mb-0">Passengers</h5>
                </div>

                <div class="card-body p-0">

                    <table class="table table-striped mb-0">

                        <thead>

                            <tr>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Seat</th>
                            </tr>

                        </thead>

                        <tbody>

                        @foreach($booking->passengers as $passenger)

                            <tr>

                                <td>{{ $passenger->name }}</td>
                                <td>{{ $passenger->age }}</td>
                                <td>{{ ucfirst($passenger->gender) }}</td>
                                <td>{{ $passenger->seat_number }}</td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- Contact -->
            <div class="card shadow-sm">

                <div class="card-header">
                    <h5 class="mb-0">Contact Information</h5>
                </div>

                <div class="card-body">

                    <table class="table table-borderless mb-0">

                        <tr>
                            <th width="180">Name</th>
                            <td>{{ $booking->contact_name }}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{ $booking->contact_email }}</td>
                        </tr>

                        <tr>
                            <th>Phone</th>
                            <td>{{ $booking->contact_phone }}</td>
                        </tr>

                    </table>

                </div>

            </div>

        </div>

        <!-- Right Column -->
        <div class="col-lg-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <h5 class="mb-0">Booking Summary</h5>
                </div>

                <div class="card-body">

                    <p class="mb-2">
                        <strong>Booking Status</strong>
                    </p>

                    <span class="badge bg-success mb-3">
                        {{ ucfirst($booking->booking_status) }}
                    </span>

                    <p class="mb-2">
                        <strong>Payment Status</strong>
                    </p>

                    <span class="badge bg-primary mb-3">
                        {{ ucfirst($booking->payment_status) }}
                    </span>

                    <hr>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Total Seats</span>
                        <strong>{{ $booking->passengers->count() }}</strong>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span>Total Amount</span>
                        <strong class="text-primary">
                            ₹{{ number_format($booking->total_amount,2) }}
                        </strong>
                    </div>

                   <a href="{{ route('booking.ticket', $booking) }}"
   class="btn btn-success">
    Download Ticket
</a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
