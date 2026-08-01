<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BookingPassenger;
use App\Models\Trip;

class SeatSelectionController extends Controller
{
    public function index(Trip $trip)
    {
        return view('frontend.seat-selection', compact('trip'));
    }

    public function bookedSeats(Trip $trip)
    {
        $bookedSeats = BookingPassenger::whereHas('booking', function ($query) use ($trip) {
            $query->where('trip_id', $trip->id)
                ->where('booking_status', 'confirmed')
                ->where('payment_status', 'paid');
        })
            ->pluck('seat_number');

        return response()->json($bookedSeats);
    }
}
