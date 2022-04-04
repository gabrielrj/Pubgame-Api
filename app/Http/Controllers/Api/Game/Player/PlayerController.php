<?php

namespace App\Http\Controllers\Api\Game\Player;

use App\Http\Controllers\Api\Game\Traits\GameControllerCallableIntercept;
use App\Http\Controllers\Controller;
use App\Services\Repositories\PlayerRepositoryInterface;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    use GameControllerCallableIntercept;

    protected PlayerRepositoryInterface $playerRepository;

    public function __construct(PlayerRepositoryInterface $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    function index(): \Illuminate\Http\JsonResponse
    {
        $this->actionName = 'get logged player data';

        return $this->run(function (){
            return [
                'player' => auth('player')->user(),
                'player_2' => auth()->user(),
            ];
        });
    }
}
