<?php

namespace App\Http\Controllers\Api\Game\Player\Shop;

use App\Http\Controllers\Api\Game\Traits\GameControllerCallableIntercept;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Game\Shop\BoxesListResource;
use App\Services\Repositories\BoxAccessoryTypeRepositoryInterface;

class BoxesController extends Controller
{
    use GameControllerCallableIntercept;

    public function getBoxesAvailableForSale(BoxAccessoryTypeRepositoryInterface $boxAccessoryTypeRepository): \Illuminate\Http\JsonResponse
    {
        $this->actionName = 'get boxes available for sale';

        return $this->run(function () use($boxAccessoryTypeRepository){
            return [
                'boxes' => BoxesListResource::collection($boxAccessoryTypeRepository->newQuery()->with('coin_type')->where('available_for_sale', '=', true)->get())
            ];
        });
    }
}
