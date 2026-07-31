@extends('frontend.layouts.app')

@section('title', 'Booking Details')

@section('content')

<div class="container py-5">

    <div class="card shadow">

        <div class="card-header">

            <h3>
                Booking Confirmed
            </h3>

        </div>


        <div class="card-body">


            <h5 class="mb-3">

                Booking Reference:

                <strong>
                    BF-{{ str_pad($booking->id,6,'0',STR_PAD_LEFT) }}
                </strong>

            </h5>


            <hr>


            <h5>
                Trip Information
            </h5>


            <table class="table">

                <tr>

                    <th>Bus</th>

                    <td>
                        {{ $booking->trip->bus->name }}
                    </td>

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

                    <th>Date</th>

                    <td>
                        {{ $booking->trip->departure_date }}
                    </td>

                </tr>


                <tr>

                    <th>Time</th>

                    <td>
                        {{ $booking->trip->departure_time }}
                    </td>

                </tr>


            </table>


            <hr>


            <h5>
                Passengers
            </h5>


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

                @foreach($booking->passengers as $passenger)

                <tr>

                    <td>
                        {{ $passenger->name }}
                    </td>

                    <td>
                        {{ $passenger->age }}
                    </td>

                    <td>
                        {{ ucfirst($passenger->gender) }}
                    </td>

                    <td>
                        {{ $passenger->seat_number }}
                    </td>

                </tr>

                @endforeach


                </tbody>

            </table>


            <hr>


            <h5>
                Payment
            </h5>


            <p>

                Status:

                <span class="badge bg-success">

                    {{ ucfirst($booking->payment_status) }}

                </span>

            </p>


            <h5>

                Total:

                ₹{{ number_format($booking->total_amount,2) }}

            </h5>


            <hr>


            <a href="{{ route('booking.ticket',$booking) }}"
               class="btn btn-success">

                Download Ticket

            </a>


        </div>

    </div>

</div>

@endsection
