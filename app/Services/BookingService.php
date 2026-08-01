<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\BookingPassenger;
use App\Models\Trip;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookingService
{
    /**
     * Create a new booking.
     */
    public function createBooking(Trip $trip, array $data): Booking
    {
        return DB::transaction(function () use ($trip, $data) {

            // Validate seats
            $this->validateSeats($trip, $data['seats']);

            // Create booking
            $booking = Booking::create([
                'booking_number' => $this->generateBookingNumber(),
                'trip_id' => $trip->id,
                'user_id' => auth()->check() ? auth()->id() : null,
                'contact_name' => $data['contact_name'],
                'contact_email' => $data['contact_email'],
                'contact_phone' => $data['contact_phone'],
                'total_amount' => $data['total_amount'],
                'booking_status' => 'pending',
                'payment_status' => 'pending',
            ]);

            // Save passengers
            $this->savePassengers(
                $booking,
                $data['passengers'],
                $data['seats'],
                $data['fare_per_seat']
            );

            return $booking;
        });
    }

    /**
     * Save booking passengers.
     */
    protected function savePassengers(
        Booking $booking,
        array $passengers,
        array $seats,
        float $farePerSeat
    ): void {

        foreach ($passengers as $index => $passenger) {

            $booking->passengers()->create([
                'seat_number' => $seats[$index],
                'passenger_name' => $passenger['name'],
                'age' => $passenger['age'],
                'gender' => $passenger['gender'],
                'fare' => $farePerSeat,
            ]);
        }
    }

    /**
     * Generate booking number.
     */
    protected function generateBookingNumber(): string
    {
        return 'BF'
            .now()->format('YmdHis')
            .strtoupper(Str::random(4));
    }

    /**
     * Calculate total fare.
     */
    public function calculateFare(Trip $trip, int $seatCount): float
    {
        return $trip->fare * $seatCount;
    }

    public function validateSeats(Trip $trip, array $seats): void
    {
        $bookedSeats = BookingPassenger::whereHas('booking', function ($query) use ($trip) {
            $query->where('trip_id', $trip->id)
                ->where('booking_status', 'confirmed');
        })
            ->whereIn('seat_number', $seats)
            ->pluck('seat_number')
            ->toArray();

        if (! empty($bookedSeats)) {
            throw new \Exception(
                'The following seats are already booked: '.implode(', ', $bookedSeats)
            );
        }
    }
}
