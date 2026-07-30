<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingPassenger extends Model
{
    protected $fillable = [
        'booking_id',
        'seat_number',
        'passenger_name',
        'age',
        'gender',
        'fare',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
