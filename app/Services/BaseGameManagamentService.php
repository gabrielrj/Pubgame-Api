<?php

namespace App\Services;

use App\Models\Game\Avatar;
use App\Services\Repositories\AccessoryOfPlayerRepositoryInterface;
use App\Services\Repositories\AvatarRepositoryInterface;
use App\Services\Traits\ServiceCallableIntercept;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseGameManagamentService implements GameManagementServiceInterface
{
    use ServiceCallableIntercept;

    /**
     * @throws Exception
     */
    public function changeAvatarLastGameDateTime(Avatar $avatar, Carbon $lastGameDate) : void
    {
        $this->run(function () use ($avatar, $lastGameDate){
            $avatarRepository = app()->make(AvatarRepositoryInterface::class);

            $avatarRepository->update($avatar, ['last_game_date' => $lastGameDate]);
        }, __FUNCTION__);
    }

    /**
     * @throws Exception
     */
    public function changeAccessoriesOfAvatarLastGameDateTime(Collection $accessories, Carbon $lastGameDate) : void
    {
        $this->run(function () use ($accessories, $lastGameDate){
            if ($accessories->count() > 0){
                $accessoryRepository = app()->make(AccessoryOfPlayerRepositoryInterface::class);

                foreach ($accessories as $accessory){
                    $accessoryRepository->update($accessory, ['last_game_date' => $lastGameDate]);
                }

            }
        }, __FUNCTION__);
    }
}
