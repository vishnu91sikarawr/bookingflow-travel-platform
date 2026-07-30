<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trip extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'bus_operator_id',
        'bus_id',
        'bus_route_id',
        'trip_code',
        'departure_date',
        'departure_time',
        'arrival_time',
        'fare',
        'available_seats',
        'status',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'departure_date' => 'date',
            'status' => 'boolean',
            'fare' => 'decimal:2',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function busOperator()
    {
        return $this->belongsTo(BusOperator::class);
    }

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function busRoute()
    {
        return $this->belongsTo(BusRoute::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function bookings()
    {
    return $this->hasMany(Booking::class);
    }
}
