@extends('frontend.layouts.app')

@section('title', 'My Bookings')

@section('content')

<div class="container py-5">

    <div class="card shadow">

        <div class="card-header">
            <h3>My Bookings</h3>
        </div>


        <div class="card-body">

            @if($bookings->count())

            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Route</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                    <tbody>

                    @foreach($bookings as $booking)

                        <tr>

                            <td>
                                #{{ $booking->id }}
                            </td>


                            <td>
                                {{ $booking->trip->busRoute->source }}
                                →
                                {{ $booking->trip->busRoute->destination }}
                            </td>


                            <td>
                                {{ $booking->trip->departure_date }}
                            </td>


                            <td>
                                ₹{{ number_format($booking->total_amount,2) }}
                            </td>


                            <td>

                                <span class="badge bg-success">
                                    {{ ucfirst($booking->booking_status) }}
                                </span>

                            </td>


                            <td>

                                <a href="{{ route('booking.details',$booking) }}"
                                   class="btn btn-sm btn-primary">

                                    View

                                </a>

                            </td>


                        </tr>

                    @endforeach


                    </tbody>

                </table>

            </div>


            @else

                <div class="alert alert-info">
                    No bookings found.
                </div>

            @endif


        </div>

    </div>

</div>

@endsection
