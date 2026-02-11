<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface PharmacyApplicationRepositoryInterface
{
    public function create(array $data);
    public function findById(int $Id);
    public function finduserapplication(int $Id, int $userId);
}
