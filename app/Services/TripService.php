<?php

namespace App\Services;

use App\Models\Bus;
use App\Models\BusOperator;
use App\Models\BusRoute;
use App\Models\Trip;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TripService
{
    /**
     * Get paginated trips.
     */
    public function paginate(?string $search = null, int $perPage = 10): LengthAwarePaginator
    {
        return Trip::with([
            'busOperator',
            'bus',
            'busRoute',
        ])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('trip_code', 'like', "%{$search}%")
                        ->orWhere('departure_date', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Create Trip.
     */
    public function create(array $data, int $userId): Trip
    {
        $bus = Bus::findOrFail($data['bus_id']);

        $data['trip_code'] = $this->generateTripCode();

        $data['available_seats'] = $bus->total_seats;

        $data['created_by'] = $userId;

        return Trip::create($data);
    }

    /**
     * Update Trip.
     */
    public function update(Trip $trip, array $data, int $userId): Trip
    {
        $bus = Bus::findOrFail($data['bus_id']);

        $data['available_seats'] = $bus->total_seats;

        $data['updated_by'] = $userId;

        $trip->update($data);

        return $trip->refresh();
    }

    /**
     * Delete Trip.
     */
    public function delete(Trip $trip): void
    {
        $trip->delete();
    }

    /**
     * Active Bus Operators.
     */
    public function getBusOperators()
    {
        return BusOperator::where('status', true)
            ->orderBy('name')
            ->get();
    }

    /**
     * Active Buses.
     */
    public function getBuses()
    {
        return Bus::where('status', true)
            ->orderBy('name')
            ->get();
    }

    /**
     * Active Routes.
     */
    public function getBusRoutes()
    {
        return BusRoute::where('status', true)
            ->orderBy('name')
            ->get();
    }

    /**
     * Generate Trip Code.
     */
    private function generateTripCode(): string
    {
        $lastTrip = Trip::latest('id')->first();

        $number = $lastTrip ? $lastTrip->id + 1 : 1;

        return 'TRP'.str_pad($number, 6, '0', STR_PAD_LEFT);
    }
}
