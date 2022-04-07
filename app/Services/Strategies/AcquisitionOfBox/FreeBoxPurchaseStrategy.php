<?php

namespace App\Services\Strategies\AcquisitionOfBox;

use App\EnumTypes\Box\BoxCostType;
use App\Exceptions\Api\Player\AcquisitionOfBox\CrateChosenByPlayerIsNotFreeException;
use App\Exceptions\Api\Player\AcquisitionOfBox\PlayerHasBoxOrFreeAvatarException;
use App\Models\Game\BoxOfPlayer;
use App\Models\Game\Player;
use App\Services\Repositories\BoxAccessoryTypeRepositoryInterface;
use App\Services\Repositories\BoxOfPlayerRepositoryInterface;
use App\Services\Traits\ServiceCallableIntercept;
use Exception;
use Illuminate\Support\Arr;

class FreeBoxPurchaseStrategy implements \App\Services\AcquisitionOfBoxServiceInterface
{
    use ServiceCallableIntercept;

    protected BoxAccessoryTypeRepositoryInterface $boxAccessoryTypeRepository;
    protected BoxOfPlayerRepositoryInterface $boxOfPlayerRepository;

    public function __construct(BoxAccessoryTypeRepositoryInterface $boxAccessoryTypeRepository,
                                BoxOfPlayerRepositoryInterface $boxOfPlayerRepository)
    {
        $this->boxAccessoryTypeRepository = $boxAccessoryTypeRepository;
        $this->boxOfPlayerRepository = $boxOfPlayerRepository;
    }

    /**
     * @throws Exception
     */
    function acquisitionOfBox(Player $player, array $payload): BoxOfPlayer
    {
        return $this->run(function () use ($player, $payload){
            throw_unless(Arr::exists($payload, 'box_type_id'), new \InvalidArgumentException('It is mandatory to choose which box will be purchased.'));

            $boxTypeId = $payload['box_type_id'];

            $boxType = $this->boxAccessoryTypeRepository->newQuery()->find($boxTypeId);

            throw_if($boxType->cost_type !== BoxCostType::Free, CrateChosenByPlayerIsNotFreeException::class);

            throw_if($player->alreadyHaveFreeBoxOrAvatar(), PlayerHasBoxOrFreeAvatarException::class);

            return $this->boxOfPlayerRepository->create([
                'box_accessory_types_id' => $boxTypeId,
                'players_id' => $player->id,
                'is_pending_payment' => false
            ]);
        }, __FUNCTION__);
    }
}
