<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Services\BookingService;

class BookingController extends Controller
{
     public function __construct(
        private BookingService $bookingService
    ) {
    }

public function passengerDetails(Request $request)
{

    $validated = $request->validate([
        'trip_id' => ['required', 'integer', 'exists:trips,id'],
        'seats' => ['required', 'array', 'min:1'],
        'seats.*' => ['required', 'string'],
    ]);

    $trip = Trip::with(['bus'])->findOrFail($validated['trip_id']);

    session([
        'booking.trip_id' => $trip->id,
        'booking.seats' => $validated['seats'],
    ]);

    $seatCount = count($validated['seats']);

    $farePerSeat = $trip->fare ?? 0;

    $totalFare = $seatCount * $farePerSeat;

    session([
        'booking.fare_per_seat' => $farePerSeat,
        'booking.total_fare' => $totalFare,
    ]);

    return view('frontend.booking.passenger-details', [
        'trip' => $trip,
        'seats' => $validated['seats'],
        'seatCount' => $seatCount,
        'farePerSeat' => $farePerSeat,
        'totalFare' => $totalFare,
    ]);
}



public function store(Request $request, Trip $trip)
{
   $validated = $request->validate([
    'passengers' => ['required', 'array', 'min:1'],
    'passengers.*.name' => ['required', 'string', 'max:255'],
    'passengers.*.age' => ['required', 'integer', 'min:1', 'max:120'],
    'passengers.*.gender' => ['required', 'in:male,female,other'],

    'seats' => ['required', 'array', 'min:1'],
    'seats.*' => ['required', 'string'],
    ]);

    $seatCount = count($validated['seats']);

    $data = [
        'contact_name'   => $validated['passengers'][0]['name'],
        'contact_email'  => null,
        'contact_phone'  => '9999999999', // Temporary
        'passengers'     => $validated['passengers'],
        'seats'          => $validated['seats'],
        'fare_per_seat'  => $trip->fare,
        'total_amount'   => $trip->fare * $seatCount,
    ];

    try {

        $booking = $this->bookingService->createBooking($trip, $data);

        return redirect()->route('booking.confirmation', $booking);


    } catch (\Exception $e) {

        return back()
            ->withInput()
            ->with('error', $e->getMessage());

    }
}
public function review(Trip $trip)
{
    $booking = session('booking');

    if (!$booking) {
        return redirect()->route('home');
    }

    $seatCount = count($booking['seats']);

    $farePerSeat = $trip->fare;

    $totalFare = $seatCount * $farePerSeat;

    return view('frontend.booking.review', compact(
        'trip',
        'booking',
        'seatCount',
        'farePerSeat',
        'totalFare'
    ));
}

public function confirmation(Booking $booking)
{
    $booking->load([
    'trip.busRoute',
    'trip.bus',
    'passengers',
   ]);

    return view(
        'frontend.booking.confirmation',
        compact('booking')
    );
}

}
