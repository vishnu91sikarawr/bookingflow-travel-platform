<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [

        'booking_number',

        'trip_id',

        'user_id',

        'contact_name',

        'contact_email',

        'contact_phone',

        'total_amount',

        'booking_status',

        'payment_status',

        'payment_reference',

    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function passengers()
    {
        return $this->hasMany(BookingPassenger::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
