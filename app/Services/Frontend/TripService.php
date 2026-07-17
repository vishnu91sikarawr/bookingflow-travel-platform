<?php

namespace App\Services\Frontend;

use App\Models\Trip;

class TripService
{
    public function search(array $filters)
    {
        return Trip::query()
            ->with([
                'bus',
                'busRoute',
                'busOperator',
            ])
            ->where('status', true)

            ->when($filters['from'] ?? null, function ($query, $from) {
                $query->whereHas('busRoute', function ($q) use ($from) {
                    $q->where('source_city', $from);
                });
            })

            ->when($filters['to'] ?? null, function ($query, $to) {
                $query->whereHas('busRoute', function ($q) use ($to) {
                    $q->where('destination_city', $to);
                });
            })

            ->when($filters['journey_date'] ?? null, function ($query, $date) {
                $query->whereDate('departure_date', $date);
            })

            ->paginate(10)
            ->withQueryString();
    }

    public function getCities(): array
{
    $cities = \App\Models\BusRoute::query()
        ->select('source_city', 'destination_city')
        ->get();

    $list = collect();

    foreach ($cities as $route) {
        $list->push($route->source_city);
        $list->push($route->destination_city);
    }

    return $list
        ->unique()
        ->sort()
        ->values()
        ->toArray();
}
}
