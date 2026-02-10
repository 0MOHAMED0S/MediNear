<?php

use App\Http\Controllers\Api\Auth\SocialAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('auth/google', [SocialAuthController::class, 'google']);
Route::post('auth/facebook', [SocialAuthController::class, 'facebook']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [SocialAuthController::class, 'logout']);
});

Route::middleware(['auth:sanctum', 'role:user'])->group(function () {});
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {});
