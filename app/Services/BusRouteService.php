<?php

namespace App\Services;

use App\Models\BusOperator;
use App\Models\BusRoute;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BusRouteService
{
    /**
     * Get paginated bus routes with optional search.
     */
    public function paginate(?string $search = null, int $perPage = 10): LengthAwarePaginator
    {
        return BusRoute::with('busOperator')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('source_city', 'like', "%{$search}%")
                        ->orWhere('destination_city', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Create a new bus route.
     */
    public function create(array $data, int $userId): BusRoute
    {
        $data['created_by'] = $userId;

        return BusRoute::create($data);
    }

    /**
     * Update an existing bus route.
     */
    public function update(BusRoute $busRoute, array $data, int $userId): BusRoute
    {
        $data['updated_by'] = $userId;

        $busRoute->update($data);

        return $busRoute->refresh();
    }

    /**
     * Soft delete a bus route.
     */
    public function delete(BusRoute $busRoute): void
    {
        $busRoute->delete();
    }

    /**
     * Get active bus operators for dropdown.
     */
    public function getBusOperators()
    {
        return BusOperator::where('status', true)
            ->orderBy('name')
            ->get();
    }
}
