<?php

namespace App\Providers;

use App\Repositories\AuthRepository;
use App\Repositories\AuthRepositoryInterface;
use App\Repositories\CourseRepository;
use App\Repositories\CourseRepositoryInterface;
use App\Repositories\UnitRepository;
use App\Repositories\UnitRepositoryInterface;
use App\Services\AuthService;
use App\Services\CourseService;
use App\Services\UnitService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(AuthService::class, function ($app) {
            return new AuthService($app->make(AuthRepositoryInterface::class));
        });

        $this->app->bind(CourseRepositoryInterface::class, CourseRepository::class);
        $this->app->bind(CourseService::class, function ($app) {
            return new CourseService($app->make(CourseRepositoryInterface::class));
        });
        $this->app->bind(UnitRepositoryInterface::class, UnitRepository::class);
        $this->app->bind(unitService::class, function ($app) {
            return new UnitService($app->make(UnitRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
