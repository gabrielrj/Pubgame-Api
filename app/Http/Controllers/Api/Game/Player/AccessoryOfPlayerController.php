<?php

namespace App\Http\Controllers\Api\Game\Player;

use App\Http\Controllers\Api\Game\Traits\GameControllerCallableIntercept;
use App\Http\Controllers\Controller;
use App\Services\Repositories\AccessoryOfPlayerRepositoryInterface;
use Illuminate\Http\Request;

class AccessoryOfPlayerController extends Controller
{
    use GameControllerCallableIntercept;

    protected AccessoryOfPlayerRepositoryInterface $accessoryOfPlayerRepository;

    public function __construct(AccessoryOfPlayerRepositoryInterface $accessoryOfPlayerRepository)
    {
        $this->accessoryOfPlayerRepository = $accessoryOfPlayerRepository;
    }

    public function getAllAccessoriesFromPlayerLogged(): \Illuminate\Http\JsonResponse
    {
        $this->actionName = 'get all accessories from player logged';

        return $this->run(function () {
            return $this->accessoryOfPlayerRepository->newQuery()
                ->with(['accessory', 'player', 'avatar'])
                ->where('players_id', '=', auth()->id())
                ->get();
        });
    }
}
