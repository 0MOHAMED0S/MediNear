<?php

use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Auth\SocialAuthController;
use App\Http\Controllers\Api\Pharmacy\PharmacyApplicationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('auth/google', [SocialAuthController::class, 'google']);
Route::post('auth/facebook', [SocialAuthController::class, 'facebook']);
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [SocialAuthController::class, 'logout']);
        
        // Route::get('/pharmacy-application/show-all-requests', [PharmacyApplicationController::class, 'index']);      // Show all requests of the authenticated user
        // Route::post('/pharmacy-application/create', [PharmacyApplicationController::class, 'store']);     // create new request
        // Route::get('/pharmacy-application/show/{id}', [PharmacyApplicationController::class, 'show']);   // show specific request details
        // Route::delete('/pharmacy-application/delete/{id}', [PharmacyApplicationController::class, 'destroy']); 
});


Route::middleware('auth:sanctum')->prefix('pharmacy-application')->group(function () {

        Route::get('/show-all-requests', [PharmacyApplicationController::class, 'index']);     // GET all
        Route::post('/create', [PharmacyApplicationController::class, 'store']);    // POST create
        Route::get('/show/{id}', [PharmacyApplicationController::class, 'show']);  // GET one
        Route::delete('/delete/{id}', [PharmacyApplicationController::class, 'destroy']); // DELETE
});

Route::middleware(['auth:sanctum', 'role:admin'])->prefix('admin')->group(function () {
        Route::get('/users', [UserController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'role:user'])->group(function () {});
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {});
