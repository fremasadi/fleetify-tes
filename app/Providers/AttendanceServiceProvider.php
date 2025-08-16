<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\AttendanceRepository;
use App\Services\AttendanceService;

class AttendanceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(AttendanceRepository::class, function ($app) {
            return new AttendanceRepository();
        });

        $this->app->singleton(AttendanceService::class, function ($app) {
            return new AttendanceService(
                $app->make(AttendanceRepository::class)
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}