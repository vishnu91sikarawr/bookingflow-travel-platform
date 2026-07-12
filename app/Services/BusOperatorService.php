<?php

namespace App\Services;

use App\Models\BusOperator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class BusOperatorService
{
    /**
     * Get paginated bus operators with optional search.
     */
    public function paginate(?string $search = null, int $perPage = 10): LengthAwarePaginator
    {
        return BusOperator::query()
            ->with(['creator', 'updater'])
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Create a new bus operator.
     *
     * @param  array<string, mixed>  $data
     */
    public function create(array $data, int $userId): BusOperator
    {
        $attributes = $this->extractAttributes($data);
        $attributes['created_by'] = $userId;

        if (isset($data['logo']) && $data['logo'] instanceof UploadedFile) {
            $attributes['logo'] = $this->storeLogo($data['logo']);
        }

        return BusOperator::create($attributes);
    }

    /**
     * Update an existing bus operator.
     *
     * @param  array<string, mixed>  $data
     */
    public function update(BusOperator $busOperator, array $data, int $userId): BusOperator
    {
        $attributes = $this->extractAttributes($data);
        $attributes['updated_by'] = $userId;

        if (isset($data['logo']) && $data['logo'] instanceof UploadedFile) {
            $this->deleteLogo($busOperator->logo);
            $attributes['logo'] = $this->storeLogo($data['logo']);
        }

        $busOperator->update($attributes);

        return $busOperator->refresh();
    }

    /**
     * Soft delete a bus operator.
     */
    public function delete(BusOperator $busOperator): void
    {
        $busOperator->delete();
    }

    /**
     * Toggle the active status of a bus operator.
     */
    public function toggleStatus(BusOperator $busOperator, int $userId): BusOperator
    {
        $busOperator->update([
            'status' => ! $busOperator->status,
            'updated_by' => $userId,
        ]);

        return $busOperator->refresh();
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function extractAttributes(array $data): array
    {
        return [
            'name' => $data['name'],
            'code' => $data['code'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'website' => $data['website'] ?? null,
            'address' => $data['address'] ?? null,
            'description' => $data['description'] ?? null,
            'status' => (bool) ($data['status'] ?? false),
        ];
    }

    private function storeLogo(UploadedFile $logo): string
    {
        return $logo->store('bus-operators/logos', 'public');
    }

    private function deleteLogo(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
