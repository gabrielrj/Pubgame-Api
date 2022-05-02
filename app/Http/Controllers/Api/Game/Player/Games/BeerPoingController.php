<?php

namespace App\Http\Controllers\Api\Game\Player\Games;

use App\Exceptions\Api\UnexpectedErrorException;
use App\Http\Controllers\Api\Game\Traits\GameControllerCallableIntercept;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Game\BeerPoingGameRequest;
use App\Services\Repositories\AvatarRepositoryInterface;
use App\Services\Repositories\PlayerRepositoryInterface;
use App\Services\Repositories\PubTableRepositoryInterface;
use App\Services\Strategies\Games\BeerPoingGameManagamentStrategy;
use App\Services\Strategies\Games\GameManagementStrategy;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;

class BeerPoingController extends Controller
{
    use GameControllerCallableIntercept;

    protected mixed $gameManagementService;
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
                'gameHasStarted' => $this->gameManagementService->startNewGame($player, $avatar, $pubTable)
            ];
        });
    }

    public function endGame(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->actionName = 'end last game started';

        return $this->run(function () use ($request) {


            $rt = $request->get('rt');

            $totalNumberOfCorrectBalls = Str::substr($rt, -2);

            if($totalNumberOfCorrectBalls > 10 || $totalNumberOfCorrectBalls < 0)
                throw new UnexpectedErrorException();

            $player = $this->playerRepository->findById($request->user()->id);

            $lastGameStarted = $this->gameManagementService->getLastGameStarted($player);

            $gameFinished = $this->gameManagementService->endGame($player, $lastGameStarted, ['total_balls' => $totalNumberOfCorrectBalls]);

            return [
                'gameHasFinished' => $gameFinished
            ];
        });
    }


}
