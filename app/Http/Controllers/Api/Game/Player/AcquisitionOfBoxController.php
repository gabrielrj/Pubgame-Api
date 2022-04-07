<?php

namespace App\Http\Controllers\Api\Game\Player;

use App\Http\Controllers\Api\Game\Traits\GameControllerCallableIntercept;
use App\Http\Controllers\Controller;
use App\Services\Repositories\PlayerRepositoryInterface;
use App\Services\Strategies\AcquisitionOfBox\AcquisitionOfBoxStrategy;
use App\Services\Strategies\AcquisitionOfBox\FreeBoxPurchaseStrategy;
use Illuminate\Http\Request;

class AcquisitionOfBoxController extends Controller
{
    use GameControllerCallableIntercept;

    protected PlayerRepositoryInterface $playerRepository;

    public function __construct(PlayerRepositoryInterface $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function freeBoxPurchase(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->actionName = '';

        return $this->run(function () use ($request){
            $acquisitionOfBoxService = new AcquisitionOfBoxStrategy(app()->make(FreeBoxPurchaseStrategy::class));

            $player = $this->playerRepository->findById(auth()->id(), ['boxes', 'avatars']);

            return $acquisitionOfBoxService->acquisitionOfBox($player, $request->all());
        });
    }
}
