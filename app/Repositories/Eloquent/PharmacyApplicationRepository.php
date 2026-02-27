<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\PharmacyApplicationRepositoryInterface;
use App\Models\PharmacyApplication;

class PharmacyApplicationRepository implements PharmacyApplicationRepositoryInterface
{
    protected PharmacyApplication $model;

    public function __construct(PharmacyApplication $model)
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

    public function findUserApplication(int $id, int $userId)
    {
        return $this->model
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();
    }

    public function getAll()
    {
        return $this->model->latest()->get();
    }

    public function hasPendingApplication(int $userId): bool
    {
        return $this->model
            ->where('user_id', $userId)
            ->where('status', 'pending')
            ->exists();
    }

    public function getByUser(int $userId)
    {
        return $this->model
            ->where('user_id', $userId)
            ->latest()
            ->get();
    }
}