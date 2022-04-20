<?php

namespace App\Http\Controllers\Api\Game\Player\Games;

use App\Http\Controllers\Api\Game\Traits\GameControllerCallableIntercept;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Game\HistoryGameRequest;
use App\Http\Resources\Api\Game\Games\History\GameHistoryResource;
use App\Services\BaseGameManagamentService;
use App\Services\Repositories\PlayerRepositoryInterface;
use App\Services\Strategies\Games\GameManagementStrategy;
use Illuminate\Contracts\Container\BindingResolutionException;
use JetBrains\PhpStorm\Pure;

class BaseGameManagamentController extends Controller
{
    use GameControllerCallableIntercept;

    protected BaseGameManagamentService $gameManagementService;
    protected PlayerRepositoryInterface $playerRepository;

    /**
     */
    public function __construct(PlayerRepositoryInterface $playerRepository)
    {
        $this->gameManagementService = new GameManagementStrategy();
        $this->playerRepository = $playerRepository;
    }

    public function getHistoryOfGames(HistoryGameRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->actionName = 'get history of games';

        return $this->run(function () use ($request) {
            $dateGame = $request->get('dateGame');

            $player = $this->playerRepository->findById($request->user()->id);

            $history = $this->gameManagementService->getHistoryGamesByDate($player, $dateGame);

            $history = !isset($history) ? [] : GameHistoryResource::collection($history);

            return [
                'history' => $history
            ];
        });
    }
}
