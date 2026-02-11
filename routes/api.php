<?php

use App\Http\Controllers\Api\Auth\SocialAuthController;
use App\Http\Controllers\Api\PharmacyApplicationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('auth/google', [SocialAuthController::class, 'google']);
Route::post('auth/facebook', [SocialAuthController::class, 'facebook']);
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [SocialAuthController::class, 'logout']);
        
        Route::post('/pharmacy-application/store', [PharmacyApplicationController::class, 'store']);
        Route::get('/pharmacy-application/show', [PharmacyApplicationController::class, 'show']);
});

Route::middleware(['auth:sanctum', 'role:user'])->group(function () {});
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {});
