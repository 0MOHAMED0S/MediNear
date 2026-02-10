<?php

namespace App\Services\Auth;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {}

    public function authenticate(string $provider, string $token)
    {
        $socialUser = Socialite::driver($provider)->stateless()->userFromToken($token);

        $user = $this->userRepository->findByProvider($provider, $socialUser->getId());

        if (!$user) {
            $user = $this->userRepository->create([
                'name' => $socialUser->getName() ?? 'User',
                'email' => $socialUser->getEmail(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
                'is_active' => true,
            ]);


            $user->assignRole('user');
        }

        return $user;
    }
}
