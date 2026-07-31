<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Services\BookingService;
use Barryvdh\DomPDF\Facade\Pdf;


use Illuminate\Support\Facades\DB;


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
    'contact_name' => ['required', 'string', 'max:255'],
    'contact_email' => ['required', 'email', 'max:255'],
    'contact_phone' => ['required', 'string', 'max:20'],
    'passengers' => ['required', 'array', 'min:1'],
    'passengers.*.name' => ['required', 'string', 'max:255'],
    'passengers.*.age' => ['required', 'integer', 'min:1', 'max:120'],
    'passengers.*.gender' => ['required', 'in:male,female,other'],

    'seats' => ['required', 'array', 'min:1'],
    'seats.*' => ['required', 'string'],
    ]);

    $seatCount = count($validated['seats']);

    $data = [
        'contact_name'   => $validated['contact_name'],
    'contact_email'  => $validated['contact_email'],
    'contact_phone'  => $validated['contact_phone'],
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

public function review(Request $request, Trip $trip)
{
    $validated = $request->validate([
        'passengers' => ['required', 'array', 'min:1'],
        'passengers.*.name' => ['required', 'string', 'max:255'],
        'passengers.*.age' => ['required', 'integer'],
        'passengers.*.gender' => ['required'],

        'seats' => ['required', 'array'],
        'seats.*' => ['required', 'string'],
        'contact_name' => ['required', 'string', 'max:255'],
        'contact_email' => ['required', 'email'],
        'contact_phone' => ['required', 'string', 'max:20'],
    ]);

    $seatCount = count($validated['seats']);

    $farePerSeat = $trip->fare;

    $totalFare = $seatCount * $farePerSeat;

    return view('frontend.booking.review', [

    'trip' => $trip,

    'passengers' => $validated['passengers'],

    'seats' => $validated['seats'],

    'contactName' => $validated['contact_name'],

    'contactEmail' => $validated['contact_email'],

    'contactPhone' => $validated['contact_phone'],

    'seatCount' => $seatCount,

    'farePerSeat' => $farePerSeat,

    'totalFare' => $totalFare,

   ]);
}




public function processPayment(Request $request)
{
    $validated = $request->validate([
        'trip_id' => ['required', 'exists:trips,id'],

        'contact_name' => ['required', 'string'],
        'contact_email' => ['required', 'email'],
        'contact_phone' => ['required', 'string'],

        'passengers' => ['required', 'array'],
        'seats' => ['required', 'array'],
    ]);

    $trip = Trip::findOrFail($validated['trip_id']);

    $seatCount = count($validated['seats']);

    $data = [
        'contact_name' => $validated['contact_name'],
        'contact_email' => $validated['contact_email'],
        'contact_phone' => $validated['contact_phone'],
        'passengers' => $validated['passengers'],
        'seats' => $validated['seats'],
        'fare_per_seat' => $trip->fare,
        'total_amount' => $trip->fare * $seatCount,
    ];

    try {

        $booking = $this->bookingService->createBooking(
            $trip,
            $data
        );

        // Dummy payment success
        return redirect()
    ->route('payment.checkout', $booking);

    } catch (\Exception $e) {

    return redirect()
        ->route('frontend.seat-selection', $validated['trip_id'])
        ->with('error', $e->getMessage());

}
}

    public function paymentSuccess(Booking $booking)
{

    $booking->update([
        'payment_status' => 'pending',
        'status' => 'pending',
    ]);


    return redirect()
        ->route('booking.confirmation',$booking)
        ->with('success','Payment successful!');

}


public function confirmation(Booking $booking)
{
    $booking->load([
        'trip.bus',
        'trip.busRoute',
        'passengers'
    ]);

    return view(
        'frontend.booking.confirmation',
        compact('booking')
    );
}

public function myBookings()
{
    $bookings = Booking::with([
            'trip.busRoute',
            'trip.bus'
        ])
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('frontend.booking.index', compact('bookings'));
}

public function showBooking(Booking $booking)
{
    // Security: only owner can view
    if ($booking->user_id !== auth()->id()) {
        abort(403);
    }

    $booking->load([
        'trip.bus',
        'trip.busRoute',
        'passengers',
    ]);

    return view('frontend.booking.show', compact('booking'));
}

public function downloadTicket(Booking $booking)
{
    if (auth()->check()) {

    if ($booking->user_id !== auth()->id()) {
        abort(403);
    }

}

    $booking->load([
        'trip.bus',
        'trip.busRoute',
        'passengers',
    ]);

    $pdf = Pdf::loadView(
        'frontend.booking.ticket',
        compact('booking')
    );

    return $pdf->download(
        'Booking-BF-' .
        str_pad($booking->id, 6, '0', STR_PAD_LEFT) .
        '.pdf'
    );
}

public function findBooking()
{
    return view('frontend.booking.find');
}

public function searchBooking(Request $request)
{
    $validated = $request->validate([
        'booking_reference' => [
            'required',
            'string'
        ],

        'email' => [
            'required',
            'email'
        ],
    ]);


    $bookingId = str_replace(
        'BF-',
        '',
        $validated['booking_reference']
    );


    $bookingId = ltrim($bookingId, '0');


    $booking = Booking::where('id', $bookingId)
        ->where('contact_email', $validated['email'])
        ->first();


    if (!$booking) {

        return back()
            ->with('error',
                'Booking not found.'
            );

    }


    return redirect()->route(
        'booking.guest-details',
        $booking
    );
}


    public function guestDetails(Booking $booking)
{
    $booking->load([
        'trip.bus',
        'trip.busRoute',
        'passengers',
    ]);

    return view(
        'frontend.booking.guest-details',
        compact('booking')
    );
}

}
