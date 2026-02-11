<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Interfaces\PharmacyApplicationRepositoryInterface;
use App\Models\PharmacyApplication;

class PharmacyApplicationRepository implements PharmacyApplicationRepositoryInterface
{
    public function create(array $data)
    {
        return PharmacyApplication::create($data);
    }

    public function findById(int $id)
    {
        return PharmacyApplication::find($id);
    }

    public function findUserApplication(int $id, int $userId)
    {
        return PharmacyApplication::where('id', $id)
            ->where('user_id', $userId)
            ->first();
    }
}