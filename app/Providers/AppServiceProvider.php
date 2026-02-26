<?php

namespace App\Providers;

use App\Repositories\Eloquent\PharmacyApplicationRepository;
use App\Repositories\Eloquent\PharmaciesRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\DeliveryRepository;
use App\Repositories\Interfaces\PharmaciesRepositoryInterface;
use App\Repositories\Interfaces\PharmacyApplicationRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Eloquent\PharmaciesRepository;
use App\Repositories\Interfaces\MedicineRepositoryInterface;
use App\Repositories\Eloquent\MedicineRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\DeliveryRepositoryInterface;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
        $this->app->bind(
            PharmacyApplicationRepositoryInterface::class,
            PharmacyApplicationRepository::class
        );
        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );
        $this->app->bind(
            PharmaciesRepositoryInterface::class,
            PharmaciesRepository::class
        );
        $this->app->bind(
            MedicineRepositoryInterface::class,
            MedicineRepository::class
        );
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(PharmacyApplicationRepositoryInterface::class,PharmacyApplicationRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(PharmaciesRepositoryInterface::class,PharmaciesRepository::class);
        $this->app->bind(DeliveryRepositoryInterface::class,DeliveryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
