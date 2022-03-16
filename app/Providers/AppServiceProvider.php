<?php

namespace App\Providers;

use App\Services\ErrorTrappingService;
use App\Services\ErrorTrappingServiceInterface;
use App\Services\Repositories\ErrorLogRepository;
use App\Services\Repositories\ErrorLogRepositoryInterface;
use App\Services\Repositories\PlayerRepository;
use App\Services\Repositories\PlayerRepositoryInterface;
use App\Services\Repositories\UserRepository;
use App\Services\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(256);
    }
}
