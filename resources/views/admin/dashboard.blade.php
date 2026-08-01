@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>BookingFlow Dashboard</h1>
@stop

@section('content')

<div class="row">


<div class="col-lg-3 col-md-6">

<div class="small-box bg-primary">

<div class="inner">

<h3>{{ $totalUsers }}</h3>

<p>Total Users</p>

</div>

<div class="icon">
<i class="fas fa-users"></i>
</div>

</div>

</div>



<div class="col-lg-3 col-md-6">

<div class="small-box bg-success">

<div class="inner">

<h3>{{ $totalCustomers }}</h3>

<p>Customers</p>

</div>

<div class="icon">
<i class="fas fa-user"></i>
</div>

</div>

</div>



<div class="col-lg-3 col-md-6">

<div class="small-box bg-info">

<div class="inner">

<h3>{{ $totalBuses }}</h3>

<p>Total Buses</p>

</div>

<div class="icon">
<i class="fas fa-bus"></i>
</div>

</div>

</div>



<div class="col-lg-3 col-md-6">

<div class="small-box bg-warning">

<div class="inner">

<h3>{{ $totalTrips }}</h3>

<p>Total Trips</p>

</div>

<div class="icon">
<i class="fas fa-route"></i>
</div>

</div>

</div>



</div>

<div class="row">


<div class="col-lg-3">

<div class="small-box bg-secondary">

<div class="inner">

<h3>{{ $totalOperators }}</h3>

<p>Bus Operators</p>

</div>

</div>

</div>



<div class="col-lg-3">

<div class="small-box bg-dark">

<div class="inner">

<h3>{{ $totalRoutes }}</h3>

<p>Routes</p>

</div>

</div>

</div>



<div class="col-lg-3">

<div class="small-box bg-danger">

<div class="inner">

<h3>{{ $totalBookings }}</h3>

<p>Total Bookings</p>

</div>

</div>

</div>



<div class="col-lg-3">

<div class="small-box bg-success">

<div class="inner">

<h3>
₹{{ number_format($totalRevenue) }}
</h3>

<p>Revenue</p>

</div>

</div>

</div>


</div>
<div class="row mt-4">

    <div class="col-lg-12">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">
                    Monthly Revenue (Demo Data)
                </h3>

            </div>

            <div class="card-body">

                <div style="height:350px;">
    <canvas id="revenueChart"></canvas>
</div>

            </div>

        </div>

    </div>

</div>
<div class="row mt-4">

    <div class="col-lg-12">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">
                    Recent Bookings
                </h3>

            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover mb-0">

                        <thead>

                            <tr>

                                <th>Booking #</th>

                                <th>Customer</th>

                                <th>Route</th>

                                <th>Travel Date</th>

                                <th>Amount</th>

                                <th>Payment</th>

                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($latestBookings as $booking)

                                <tr>

                                    <td>
                                        {{ $booking->booking_number }}
                                    </td>

                                    <td>
                                        {{ $booking->contact_name }}
                                    </td>

                                    <td>

                                        {{ optional(optional($booking->trip)->busRoute)->source_city }}

                                        →

                                        {{ optional(optional($booking->trip)->busRoute)->destination_city }}

                                    </td>

                                    <td>

                                        {{ optional($booking->trip)->departure_time
                                            ? \Carbon\Carbon::parse($booking->trip->departure_time)->format('d M Y')
                                            : '-' }}

                                    </td>

                                    <td>

                                        ₹{{ number_format($booking->total_amount) }}

                                    </td>

                                    <td>

                                        @if($booking->payment_status == 'paid')

                                            <span class="badge badge-success">
                                                Paid
                                            </span>

                                        @else

                                            <span class="badge badge-warning">
                                                Pending
                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        @if($booking->booking_status == 'confirmed')

                                            <span class="badge badge-primary">
                                                Confirmed
                                            </span>

                                        @else

                                            <span class="badge badge-secondary">
                                                {{ ucfirst($booking->booking_status) }}
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="7" class="text-center py-4">

                                        No bookings available.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>
@stop
@section('js')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('revenueChart');

new Chart(ctx, {

    type: 'line',

    data: {

        labels: [
            'Jan','Feb','Mar','Apr','May','Jun',
            'Jul','Aug','Sep','Oct','Nov','Dec'
        ],

        datasets: [{

            label: 'Revenue (₹)',

            data: @json($revenueChart),

            borderColor: '#007bff',

            backgroundColor: 'rgba(0,123,255,0.15)',

            borderWidth: 3,

            fill: true,

            tension: 0.4

        }]

    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        plugins: {

            legend: {

                display: true

            }

        }

    }

});

</script>

@stop
