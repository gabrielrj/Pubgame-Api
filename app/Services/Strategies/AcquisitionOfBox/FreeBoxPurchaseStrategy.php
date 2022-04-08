<?php

namespace App\Services\Strategies\AcquisitionOfBox;

use App\EnumTypes\Accessory\AccessoryEdition;
use App\EnumTypes\Avatar\AvatarTypeOfCost;
use App\EnumTypes\Box\BoxCostType;
use App\Exceptions\Api\Player\AcquisitionOfBox\CrateChosenByPlayerIsNotFreeException;
use App\Exceptions\Api\Player\AcquisitionOfBox\PlayerHasBoxOrFreeAvatarException;
use App\Models\Game\Player;
use App\Services\AccessoryServiceInterface;
use App\Services\AvatarServiceInterface;
use App\Services\Repositories\AccessoryRepositoryInterface;
use App\Services\Repositories\BoxAccessoryTypeRepositoryInterface;
use App\Services\Traits\ServiceCallableIntercept;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class FreeBoxPurchaseStrategy implements \App\Services\AcquisitionOfBoxServiceInterface
{
    use ServiceCallableIntercept;

    protected BoxAccessoryTypeRepositoryInterface $boxAccessoryTypeRepository;
    protected AccessoryRepositoryInterface $accessoryRepository;
    protected AccessoryServiceInterface $accessoryService;
    protected AvatarServiceInterface $avatarService;

    public function __construct(BoxAccessoryTypeRepositoryInterface $boxAccessoryTypeRepository,
                                AccessoryRepositoryInterface $accessoryRepository,
                                AccessoryServiceInterface $accessoryService,
                                AvatarServiceInterface $avatarService)
    {
        $this->boxAccessoryTypeRepository = $boxAccessoryTypeRepository;
        $this->accessoryRepository = $accessoryRepository;
        $this->accessoryService = $accessoryService;
        $this->avatarService = $avatarService;
    }

    /**
     * @throws Exception
     */
    function acquisitionOfBox(Player $player, array $payload): bool
    {
        return $this->run(function () use ($player, $payload){
            throw_unless(Arr::exists($payload, 'box_type_id'), new \InvalidArgumentException('It is mandatory to choose which box will be purchased.'));

            $boxTypeId = $payload['box_type_id'];

            $boxType = $this->boxAccessoryTypeRepository->newQuery()->find($boxTypeId);

            throw_if($boxType->cost_type !== BoxCostType::Free, CrateChosenByPlayerIsNotFreeException::class);

            throw_if($player->alreadyHaveFreeBoxOrAvatar(), PlayerHasBoxOrFreeAvatarException::class);

            $accessoryFree1 = $this->accessoryRepository->newQuery()
                ->where('is_free', '=', true)
                ->where('available_for_sale', '=', true)
                ->where('edition', '=', AccessoryEdition::DefaultEdition)
                ->orderByDesc('created_at')
                ->first();

            $accessoryFree2 = $this->accessoryRepository->newQuery()
                ->where('is_free', '=', true)
                ->where('available_for_sale', '=', true)
                ->where('edition', '=', AccessoryEdition::DefaultEdition)
                ->orderBy('created_at')
                ->first();


            return DB::transaction(function () use ($boxType, $player, $accessoryFree1, $accessoryFree2) {
                if($boxType->contains_avatar)
                    $this->avatarService->createNewAvatar($player, AvatarTypeOfCost::Free);

                $this->accessoryService->createNewAccessoryToPlayer($player, $accessoryFree1) != null;
                return $this->accessoryService->createNewAccessoryToPlayer($player, $accessoryFree2) != null;
            });
        }, __FUNCTION__);
    }
}
