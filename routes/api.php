<?php

use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\Categories\CategoriesController;
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
    Route::post('/create', [PharmacyApplicationController::class, 'store']);
    Route::get('/show/{id}', [PharmacyApplicationController::class, 'show']);
    Route::delete('/delete/{id}', [PharmacyApplicationController::class, 'destroy']);
});

Route::middleware(['auth:sanctum', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/show-all-applications', [PharmacyApplicationController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'role:admin'])->prefix('admin/categories')->group(function () { 
    Route::post('/create', [CategoriesController::class, 'create']);
    Route::put('/update/{id}', [CategoriesController::class, 'update']);
    Route::delete('/delete/{id}', [CategoriesController::class, 'delete']);
    Route::get('/not-active', [CategoriesController::class, 'notactive']);
});


Route::middleware(['auth:sanctum', 'role:user'])->group(function () {

});
