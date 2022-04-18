<?php

namespace App\Http\Controllers\Api\Game\Player\Games;

use App\Http\Controllers\Api\Game\Traits\GameControllerCallableIntercept;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Game\BeerPoingGameRequest;
use App\Services\GameManagementServiceInterface;
use App\Services\Repositories\AvatarRepositoryInterface;
use App\Services\Repositories\PlayerRepositoryInterface;
use App\Services\Repositories\PubTableRepositoryInterface;
use App\Services\Strategies\Games\BeerPoingGameManagamentStrategy;
use App\Services\Strategies\Games\GameManagementStrategy;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\Pure;

class BeerPoingController extends Controller
{
    use GameControllerCallableIntercept;

    protected GameManagementServiceInterface $gameManagementService;
    protected PlayerRepositoryInterface $playerRepository;
    protected AvatarRepositoryInterface $avatarRepository;
    protected PubTableRepositoryInterface $pubTableRepository;

    #[Pure]
    public function __construct(BeerPoingGameManagamentStrategy $beerPoingGameManagamentStrategy,
                                PlayerRepositoryInterface $playerRepository,
                                PubTableRepositoryInterface $pubTableRepository,
                                AvatarRepositoryInterface $avatarRepository)
    {
        $this->gameManagementService = new GameManagementStrategy($beerPoingGameManagamentStrategy);
        $this->playerRepository = $playerRepository;
        $this->pubTableRepository = $pubTableRepository;
        $this->avatarRepository = $avatarRepository;
    }

    public function startNewBeerPoingGame(BeerPoingGameRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->actionName = 'start new beer poing game';

        return $this->run(function () use($request){
            $player = $this->playerRepository->findById($request->user()->id);

            $avatar = $this->avatarRepository->findByUuid($request->get('avTiD'));

            $pubTable = $this->pubTableRepository->findById($request->get('pubTiD'));

            return [
                $this->gameManagementService->startNewGame($player, $avatar, $pubTable)
            ];
        });
    }
}
