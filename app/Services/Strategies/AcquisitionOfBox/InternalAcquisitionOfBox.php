<?php

namespace App\Services\Strategies\AcquisitionOfBox;

use App\EnumTypes\Avatar\AvatarTypeOfCost;
use App\EnumTypes\Box\BoxCostType;
use App\Exceptions\Api\Player\AcquisitionOfBox\BoxUnavailableForSaleException;
use App\Exceptions\Api\Player\AcquisitionOfBox\InvalidBoxException;
use App\Exceptions\Api\Player\AcquisitionOfBox\PlayerAlreadyHasAvatarLimitException;
use App\Models\Game\Player;
use App\Services\AccessoryRaffleByBoxServiceInterface;
use App\Services\AccessoryServiceInterface;
use App\Services\AvatarServiceInterface;
use App\Services\RegisterTransactionServiceInterface;
use App\Services\Repositories\BoxAccessoryTypeRepositoryInterface;
use App\Services\Strategies\Transactions\BoxPurchaseInternalTransactionStrategy;
use App\Services\Strategies\Transactions\RegisterTransactionStrategy;
use App\Services\Traits\ServiceCallableIntercept;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class InternalAcquisitionOfBox implements \App\Services\AcquisitionOfBoxServiceInterface
{
    use ServiceCallableIntercept;

    protected BoxAccessoryTypeRepositoryInterface $boxAccessoryTypeRepository;
    protected AvatarServiceInterface $avatarService;
    protected AccessoryServiceInterface $accessoryService;
    protected AccessoryRaffleByBoxServiceInterface $accessoryRaffleByBoxService;
    protected RegisterTransactionServiceInterface $transactionService;

    public function __construct(BoxAccessoryTypeRepositoryInterface $boxAccessoryTypeRepository,
                                AccessoryRaffleByBoxServiceInterface $accessoryRaffleByBoxService,
                                AvatarServiceInterface $avatarService,
                                AccessoryServiceInterface $accessoryService)
    {
        $this->boxAccessoryTypeRepository = $boxAccessoryTypeRepository;
        $this->avatarService = $avatarService;
        $this->accessoryService = $accessoryService;
        $this->accessoryRaffleByBoxService = $accessoryRaffleByBoxService;
    }

    /**
     * @throws Exception
     */
    function acquisitionOfBox(Player $player, array $payload): array
    {
        return $this->run(function () use ($player, $payload) {
            throw_unless(Arr::exists($payload, 'box_type_id'), new \InvalidArgumentException('It is mandatory to choose which box will be purchased.'));

            $boxTypeId = $payload['box_type_id'];

            $boxType = $this->boxAccessoryTypeRepository->newQuery()->find($boxTypeId);

            //This service only purchases paid chests.
            throw_if($boxType->cost_type !== BoxCostType::Paid, InvalidBoxException::class);

            //The chest must be available for purchase.
            throw_unless($boxType->available_for_sale || $boxType->quantity_for_sale <= 0, BoxUnavailableForSaleException::class);

            $this->transactionService = new RegisterTransactionStrategy(app()->make(BoxPurchaseInternalTransactionStrategy::class));

            return DB::transaction(function () use ($player, $boxType) {
                //$this->transactionService->createNewTransaction($player, ['coin_types_id' => $boxType->price_coin_id, 'box_price' => $boxType->price]);

                $avatar = null;

                if($boxType->contains_avatar) {
                    throw_if($player->alreadyReachedAvatarLimit(), PlayerAlreadyHasAvatarLimitException::class);

                    $avatar = $this->avatarService->createNewAvatar($player, AvatarTypeOfCost::Paid);
                }

                $accessoryForSale = $this->accessoryRaffleByBoxService->returnsDrawnAccessory($boxType);

                $accessory = $this->accessoryService->createNewAccessoryToPlayer($player, $accessoryForSale);

                $this->transactionService->createNewTransaction($player,
                    ['coin_types_id' => $boxType->price_coin_id, 'box_price' => $boxType->price],
                    $avatar, $accessory);

                return [
                    'avatar' => $avatar,
                    'accessory' => $accessory,
                ];
            });
        }, __FUNCTION__);
    }
}
