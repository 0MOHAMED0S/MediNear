<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function findByProvider(string $provider, string $providerId): ?User;
    public function create(array $data): User;
    public function updateLocation(User $user, float $latitude, float $longitude): User;
}
