<?php

namespace App\Services\Admin\Pharmacies;
interface PharmaciesRepositoryInterface
{
    public function create(array $data);
    public function findById(int $id);
    public function getAll();
}