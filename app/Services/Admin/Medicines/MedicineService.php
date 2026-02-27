<?php

namespace App\Services\Admin\Medicines;

use App\Models\Medicine;
use App\Repositories\Interfaces\MedicineRepositoryInterface;

class MedicineService
{
    protected MedicineRepositoryInterface $medicineRepository;

    public function __construct(MedicineRepositoryInterface $medicineRepository)
    {
        $this->medicineRepository = $medicineRepository;
    }

    public function getAll(int $perPage = 10, int $page = 1)
{
    return $this->medicineRepository->getAll($perPage, $page);
}

public function find(int $id): Medicine
{
    $medicine = $this->medicineRepository->findById($id);

    if (!$medicine) {
        throw new \Exception('Medicine not found');
    }

    return $medicine;
}

public function exists(int $id): bool
{
    return $this->medicineRepository->exists($id);
}

    public function create(array $data): Medicine
    {
        return $this->medicineRepository->create($data);
    }

    public function update(Medicine $medicine, array $data): Medicine
    {
        return $this->medicineRepository->update($medicine, $data);
    }

    public function delete(Medicine $medicine): bool
    {
        return $this->medicineRepository->delete($medicine);
    }
}
