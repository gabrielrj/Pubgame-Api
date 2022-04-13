<?php

namespace App\Http\Controllers\Api\Game\Player\Shop;

use App\Http\Controllers\Api\Game\Traits\GameControllerCallableIntercept;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Game\FreeAcquisitionBoxRequest;
use App\Http\Requests\Api\Game\InternalPurchaseBoxRequest;
use App\Services\AcquisitionOfBoxServiceInterface;
use App\Services\Repositories\PlayerRepositoryInterface;
use App\Services\Strategies\AcquisitionOfBox\AcquisitionOfBoxStrategy;
use App\Services\Strategies\AcquisitionOfBox\FreeBoxPurchaseStrategy;
use App\Services\Strategies\AcquisitionOfBox\InternalAcquisitionOfBox;
use function app;
use function auth;

class AcquisitionOfBoxController extends Controller
{
    use GameControllerCallableIntercept;

    protected PlayerRepositoryInterface $playerRepository;
    protected AcquisitionOfBoxServiceInterface $acquisitionOfBoxService;

    public function __construct(PlayerRepositoryInterface $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function freeBoxAcquisition(FreeAcquisitionBoxRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->actionName = 'free box acquisition';

        return $this->run(function () use ($request){
            $this->acquisitionOfBoxService = new AcquisitionOfBoxStrategy(app()->make(FreeBoxPurchaseStrategy::class));

            $player = $this->playerRepository->findById(auth()->id(), ['boxes', 'avatars']);

            return $this->acquisitionOfBoxService->acquisitionOfBox($player, $request->all());
        });
    }

    public function internalBoxPurchase(InternalPurchaseBoxRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->actionName = 'internal box purchase';

        return $this->run(function () use ($request) {
            $this->acquisitionOfBoxService = new AcquisitionOfBoxStrategy(app()->make(InternalAcquisitionOfBox::class));

            $player = $this->playerRepository->findById(auth()->id(), ['boxes', 'avatars']);

            return $this->acquisitionOfBoxService->acquisitionOfBox($player, $request->all());
        });
    }
}
