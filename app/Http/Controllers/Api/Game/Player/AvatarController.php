<?php

namespace App\Http\Controllers\Api\Game\Player;

use App\Http\Controllers\Api\Game\Traits\GameControllerCallableIntercept;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Game\Player\Avatars\PlayerAvatarsResource;
use App\Services\Repositories\AvatarRepositoryInterface;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    use GameControllerCallableIntercept;

    protected AvatarRepositoryInterface $avatarRepository;

    public function __construct(AvatarRepositoryInterface $avatarRepository)
    {
        $this->avatarRepository = $avatarRepository;
    }

    public function getAllAvatarsFromPlayerLogged(): \Illuminate\Http\JsonResponse
    {
        $this->actionName = 'get all avatars from player logged';

        return $this->run(function () {
            $avatares = $this->avatarRepository->newQuery()
                ->with(['accessories.accessory', 'player'])
                ->where('players_id', '=', auth()->id())
                ->get();

            return PlayerAvatarsResource::collection($avatares);
        });
    }
}
