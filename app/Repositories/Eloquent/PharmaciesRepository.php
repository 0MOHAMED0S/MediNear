<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Interfaces\PharmaciesRepositoryInterface;
use App\Models\Pharmacy;
class PharmaciesRepository implements PharmaciesRepositoryInterface
{
    protected Pharmacy $model;

    public function __construct(Pharmacy $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function findById(int $id)
    {
        return $this->model->find($id);
    }

    public function getAll()
    {
        return $this->model->latest()->get();
    }
}