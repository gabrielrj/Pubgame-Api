<?php

namespace App\Providers;

use App\Services\ErrorTrappingService;
use App\Services\ErrorTrappingServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServiceBindProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //Others Services//
        $this->app->bind(ErrorTrappingServiceInterface::class, ErrorTrappingService::class);
    }
}
