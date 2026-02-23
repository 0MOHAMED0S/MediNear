<?php 

namespace App\Repositories\Interfaces;
interface PharmaciesRepositoryInterface
{
    public function create(array $data);

    public function findById(int $id);

    public function getAll();
}