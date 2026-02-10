<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialAuthRequest;
use App\Services\Auth\SocialAuthService;
use App\Traits\ApiResponseTrait;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;

class SocialAuthController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected SocialAuthService $socialAuthService) {}
    public function google(SocialAuthRequest $request)
    {
        return $this->handleApi(function () use ($request) {
            $user = $this->socialAuthService->authenticate('google', $request->access_token);
            return [
                'token' => $user->createToken('api_token')->plainTextToken,
                'user' => $user->only(['id', 'name', 'email', 'avatar']) + ['role' => $user->role],
            ];
        }, 'Login successful');
    }
    public function facebook(SocialAuthRequest $request)
    {
        return $this->handleApi(function () use ($request) {
            $user = $this->socialAuthService->authenticate('facebook', $request->access_token);
            return [
                'token' => $user->createToken('api_token')->plainTextToken,
                'user' => $user->only(['id', 'name', 'email', 'avatar']) + ['role' => $user->role],
            ];
        }, 'Login successful');
    }
    public function logout(Request $request)
    {
        return $this->handleApi(function () use ($request) {
            // Revoke current token
            $request->user()->currentAccessToken()->delete();
        }, 'Logout successful');
    }
}
