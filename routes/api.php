<?php

use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\Categories\CategoriesController;
use App\Http\Controllers\Api\Admin\Medicines\MedicineController;
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


Route::middleware(['auth:sanctum', 'role:pharmacy'])->prefix('pharmacy-application')->group(function () {
    Route::get('/show/{id}', [PharmacyApplicationController::class, 'show']);
    Route::delete('/delete/{id}', [PharmacyApplicationController::class, 'destroy']);
});

Route::middleware(['auth:sanctum', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/show-all-applications', [PharmacyApplicationController::class, 'index']);
    Route::apiResource('medicines', MedicineController::class);
});

//route resource

Route::middleware(['auth:sanctum', 'role:admin'])->prefix('admin/categories')->group(function () {
    Route::post('/create', [CategoriesController::class, 'create']);
    Route::put('/update/{id}', [CategoriesController::class, 'update']);
    Route::delete('/delete/{id}', [CategoriesController::class, 'delete']);
    Route::get('/not-active', [CategoriesController::class, 'notactive']);
});

//pharmacies
Route::middleware(['auth:sanctum', 'role:admin'])->prefix('admin/pharmacies')->group(function () {
    Route::get('/show-all', [PharmaciesController::class, 'index']);
    Route::post('/approve/{id}', [PharmaciesController::class, 'approve']);
    Route::post('/reject/{id}', [PharmaciesController::class, 'reject']);
});
//deliveries
//Route::apiResource('', Controller::class);
Route::middleware(['auth:sanctum', 'role:admin'])->prefix('admin')->group(function () { 
Route::apiResource('deliveries', DeliveryController::class);
});



Route::middleware(['auth:sanctum', 'role:user'])->group(function () {
    Route::post('/pharmacy-application/create', [PharmacyApplicationController::class, 'store']);
});
