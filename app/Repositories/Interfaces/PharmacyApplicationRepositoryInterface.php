<?php

namespace App\Repositories\Interfaces;

interface PharmacyApplicationRepositoryInterface
{
    public function create(array $data);

    public function findById(int $id);

    public function findUserApplication(int $id, int $userId);
    public function getAll();
    public function hasPendingApplication(int $userId);
    public function getByUser(int $userId);
}