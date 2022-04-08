<?php

namespace App\Services;

use App\Models\Game\Avatar;
use App\Models\Game\Player;
use App\Services\Repositories\AvatarRepositoryInterface;
use App\Services\Traits\ServiceCallableIntercept;
use Exception;

class AvatarService implements AvatarServiceInterface
{
    use ServiceCallableIntercept;

    protected AvatarRepositoryInterface $avatarRepository;

    public function __construct(AvatarRepositoryInterface $avatarRepository)
    {
        $this->avatarRepository = $avatarRepository;
    }

    /**
     * @throws Exception
     */
    public function createNewAvatar(Player $player, string $costType) : Avatar
    {
        $this->run(function () use($player, $costType){
            return $this->avatarRepository->create([
                'players_id' => $player->id,
                'surname' => 'Avatar #' . ($player->avatars()->count() + 1),
                'cost_type' => $costType,
                'box_id' => null,
                'color' => 'blue',
            ]);
        }, __FUNCTION__);
    }
}
