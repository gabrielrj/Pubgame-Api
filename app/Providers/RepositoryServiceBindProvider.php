<?php

namespace App\Providers;

use App\Services\Repositories\BaseRepository;
use App\Services\Repositories\ErrorLogRepository;
use App\Services\Repositories\ErrorLogRepositoryInterface;
use App\Services\Repositories\PlayerRepository;
use App\Services\Repositories\PlayerRepositoryInterface;
use App\Services\Repositories\RepositoryInterface;
use App\Services\Repositories\UserRepository;
use App\Services\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceBindProvider extends ServiceProvider
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
        /**** Services ****/

        //Repositories//
        //$this->app->bind(RepositoryInterface::class, BaseRepository::class);
        $this->app->bind(PlayerRepositoryInterface::class, PlayerRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ErrorLogRepositoryInterface::class, ErrorLogRepository::class);
    }
}
