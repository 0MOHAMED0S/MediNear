<?php

namespace App\Providers;

use App\Repositories\Eloquent\PharmacyApplicationRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Interfaces\PharmacyApplicationRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class,
         UserRepository::class);
        $this->app->bind(PharmacyApplicationRepositoryInterface::class, 
        PharmacyApplicationRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, 
        CategoryRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
