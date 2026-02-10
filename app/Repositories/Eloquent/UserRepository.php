<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function findByProvider(string $provider, string $providerId): ?User
    {
        return User::where('provider', $provider)
            ->where('provider_id', $providerId)
            ->first();
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function updateLocation(User $user, float $latitude, float $longitude): User
    {
        $user->update([
            'latitude' => $latitude,
            'longitude' => $longitude
        ]);

        return $user;
    }
}
