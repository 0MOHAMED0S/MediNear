<?php

use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\Categories\CategoriesController;
use App\Http\Controllers\Api\Admin\Pharmacies\PharmaciesController;
use App\Http\Controllers\Api\Admin\Delivery\DeliveryController;
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
});


Route::middleware(['auth:sanctum', 'role:user'])->prefix('pharmacy-application')->group(function () {
    Route::get('/show/{id}', [PharmacyApplicationController::class, 'show']);
    Route::delete('/delete/{id}', [PharmacyApplicationController::class, 'destroy']);
    
});

Route::middleware(['auth:sanctum', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/show-all-applications', [PharmacyApplicationController::class, 'index']);
});

//pharmacies
//Categories
//deliveries
//Route::apiResource
Route::middleware(['auth:sanctum', 'role:admin'])->prefix('admin')->group(function () { 
    Route::apiResource('pharmacies', PharmaciesController::class);
    Route::apiResource('categories', CategoriesController::class);
    Route::apiResource('deliveries', DeliveryController::class);
});



Route::middleware(['auth:sanctum', 'role:user'])->group(function () {
        Route::post('/pharmacy-application/create', [PharmacyApplicationController::class, 'store']);

    
});
