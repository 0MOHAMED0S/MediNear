<?php

namespace App\Repositories\Interfaces;

use App\Models\Medicine;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface MedicineRepositoryInterface
{
public function getAll(int $perPage = 10, int $page = 1): LengthAwarePaginator;

    public function findById(int $id): ?Medicine;

    public function exists(int $id): bool;

    public function create(array $data): Medicine;

    public function update(Medicine $medicine, array $data): Medicine;

    public function delete(Medicine $medicine): bool;
}
