<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Bus Ticket</title>

    <style>

        body{
            font-family: DejaVu Sans, sans-serif;
            font-size:14px;
            color:#333;
        }

        h1{
            text-align:center;
            margin-bottom:5px;
        }

        h3{
            margin-top:25px;
            border-bottom:1px solid #ddd;
            padding-bottom:5px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:10px;
        }

        table td,
        table th{

            border:1px solid #ddd;
            padding:8px;

        }

        .summary td{
            border:none;
            padding:4px;
        }

        .status{

            font-weight:bold;
            color:green;

        }

    </style>

</head>

<body>

<h1>BookingFlow</h1>

<p style="text-align:center">
    Bus Ticket
</p>

<hr>

<h3>Booking Information</h3>

<table class="summary">

<tr>

    <td><strong>Booking Ref</strong></td>

    <td>
        BF-{{ str_pad($booking->id,6,'0',STR_PAD_LEFT) }}
    </td>

</tr>

<tr>

    <td><strong>Status</strong></td>

    <td>{{ ucfirst($booking->booking_status) }}</td>

</tr>

<tr>

    <td><strong>Payment</strong></td>

    <td>{{ ucfirst($booking->payment_status) }}</td>

</tr>

</table>


<h3>Trip Details</h3>

<table>

<tr>

    <th>Bus</th>

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

    <th>Date</th>

    <td>

        {{ \Carbon\Carbon::parse($booking->trip->departure_date)->format('d M Y') }}

    </td>

</tr>

<tr>

    <th>Departure Time</th>

    <td>

        {{ \Carbon\Carbon::parse($booking->trip->departure_time)->format('h:i A') }}

    </td>

</tr>

</table>


<h3>Contact Information</h3>

<table>

<tr>

    <th>Name</th>

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


<h3>Passengers</h3>

<table>

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


<h3>Fare Summary</h3>

<table class="summary">

<tr>

    <td><strong>Total Seats</strong></td>

    <td>{{ $booking->passengers->count() }}</td>

</tr>

<tr>

    <td><strong>Total Amount</strong></td>

    <td>

        ₹{{ number_format($booking->total_amount,2) }}

    </td>

</tr>

</table>

<br><br>

<p style="text-align:center">

    Thank you for choosing BookingFlow.

</p>

</body>

</html>
