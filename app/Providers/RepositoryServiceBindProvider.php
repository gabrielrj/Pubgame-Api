<?php

namespace App\Providers;

use App\Services\Repositories\AccessoryOfPlayerRepository;
use App\Services\Repositories\AccessoryOfPlayerRepositoryInterface;
use App\Services\Repositories\AccessoryRarityTypeRepository;
use App\Services\Repositories\AccessoryRarityTypeRepositoryInterface;
use App\Services\Repositories\AccessoryRepository;
use App\Services\Repositories\AccessoryRepositoryInterface;
use App\Services\Repositories\AccessoryTypeRepository;
use App\Services\Repositories\AccessoryTypeRepositoryInterface;
use App\Services\Repositories\AvatarRepository;
use App\Services\Repositories\AvatarRepositoryInterface;
use App\Services\Repositories\BaseRepository;
use App\Services\Repositories\BoxAccessoryRarityTypeRepository;
use App\Services\Repositories\BoxAccessoryRarityTypeRepositoryInterface;
use App\Services\Repositories\BoxAccessoryTypeRepository;
use App\Services\Repositories\BoxAccessoryTypeRepositoryInterface;
use App\Services\Repositories\BoxOfPlayerRepository;
use App\Services\Repositories\BoxOfPlayerRepositoryInterface;
use App\Services\Repositories\CoinTypeRepository;
use App\Services\Repositories\CoinTypeRepositoryInterface;
use App\Services\Repositories\ErrorLogRepository;
use App\Services\Repositories\ErrorLogRepositoryInterface;
use App\Services\Repositories\GameTypeRepository;
use App\Services\Repositories\GameTypeRepositoryInterface;
use App\Services\Repositories\PlayerRepository;
use App\Services\Repositories\PlayerRepositoryInterface;
use App\Services\Repositories\PubTableRepository;
use App\Services\Repositories\PubTableRepositoryInterface;
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
        $this->app->bind(AccessoryRarityTypeRepositoryInterface::class, AccessoryRarityTypeRepository::class);
        $this->app->bind(AccessoryRepositoryInterface::class, AccessoryRepository::class);
        $this->app->bind(AccessoryTypeRepositoryInterface::class, AccessoryTypeRepository::class);
        $this->app->bind(BoxAccessoryRarityTypeRepositoryInterface::class, BoxAccessoryRarityTypeRepository::class);
        $this->app->bind(BoxAccessoryTypeRepositoryInterface::class, BoxAccessoryTypeRepository::class);
        $this->app->bind(CoinTypeRepositoryInterface::class, CoinTypeRepository::class);
        $this->app->bind(GameTypeRepositoryInterface::class, GameTypeRepository::class);
        $this->app->bind(PubTableRepositoryInterface::class, PubTableRepository::class);
        $this->app->bind(AccessoryOfPlayerRepositoryInterface::class, AccessoryOfPlayerRepository::class);
        $this->app->bind(BoxOfPlayerRepositoryInterface::class, BoxOfPlayerRepository::class);
        $this->app->bind(AvatarRepositoryInterface::class, AvatarRepository::class);
    }
}
