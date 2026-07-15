<?php

namespace App\Services;

use App\Models\Bus;
use App\Models\BusOperator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BusService
{
    /**
     * Get paginated buses with optional search.
     */
    public function paginate(?string $search = null, int $perPage = 10): LengthAwarePaginator
    {
        return Bus::with('busOperator')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('bus_number', 'like', "%{$search}%")
                        ->orWhere('registration_number', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Create a new bus.
     */
    public function create(array $data, int $userId): Bus
    {
        $data['created_by'] = $userId;

        return Bus::create($data);
    }

    /**
     * Update an existing bus.
     */
    public function update(Bus $bus, array $data, int $userId): Bus
    {
        $data['updated_by'] = $userId;

        $bus->update($data);

        return $bus->refresh();
    }

    /**
     * Soft delete a bus.
     */
    public function delete(Bus $bus): void
    {
        $bus->delete();
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
