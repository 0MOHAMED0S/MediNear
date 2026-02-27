<?php

namespace App\Repositories\Eloquent;

use App\Models\Medicine;
use App\Repositories\Interfaces\MedicineRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class MedicineRepository implements MedicineRepositoryInterface
{
    public function getAll(int $perPage = 10, int $page = 1): LengthAwarePaginator
    {
        return Medicine::with('category')
            ->latest()
            ->paginate(
                perPage: $perPage,
                page: $page
            );
    }

    public function findById(int $id): ?Medicine
    {
        return Medicine::with('category')->find($id);
    }

    public function exists(int $id): bool
    {
        return Medicine::where('id', $id)->exists();
    }

    public function create(array $data): Medicine
    {
        if (isset($data['image'])) {
            $data['image'] = $data['image']->store('medicines', 'public');
        }

        return Medicine::create($data);
    }

    public function update(Medicine $medicine, array $data): Medicine
    {
        if (isset($data['image'])) {
            if ($medicine->image && Storage::disk('public')->exists($medicine->image)) {
                Storage::disk('public')->delete($medicine->image);
            }
            $data['image'] = $data['image']->store('medicines', 'public');
        }

        $medicine->update($data);

        return $medicine->fresh();
    }

    public function delete(Medicine $medicine): bool
    {
        if ($medicine->image && Storage::disk('public')->exists($medicine->image)) {
            Storage::disk('public')->delete($medicine->image);
        }

        return $medicine->delete();
    }
}
