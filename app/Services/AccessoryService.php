<?php

namespace App\Services;

use App\EnumTypes\Accessory\AccessoryEdition;
use App\Models\Game\AccessoryOfPlayer;
use App\Models\Game\Player;
use App\Models\Game\Settings\Accessory;
use App\Services\Repositories\AccessoryOfPlayerRepositoryInterface;
use App\Services\Traits\ServiceCallableIntercept;
use Exception;
use Illuminate\Support\Facades\DB;

class AccessoryService implements AccessoryServiceInterface
{
    use ServiceCallableIntercept;

    protected AccessoryOfPlayerRepositoryInterface $accessoryOfPlayerRepository;

    public function __construct(AccessoryOfPlayerRepositoryInterface $accessoryOfPlayerRepository)
    {
        $this->accessoryOfPlayerRepository = $accessoryOfPlayerRepository;
    }

    /**
     * @throws Exception
     */
    function createNewAccessoryToPlayer(Player $player, Accessory $accessory, bool $pendingPayment = false): AccessoryOfPlayer
    {
        return $this->run(function () use($player, $accessory, $pendingPayment) {
            return DB::transaction(function () use ($player, $accessory, $pendingPayment) {
                if($accessory->edition == AccessoryEdition::SpecialEdition)
                    $this->updateAccessoriesStock($accessory);

                return $this->accessoryOfPlayerRepository->create([
                    'accessories_id' => $accessory->id,
                    'players_id' => $player->id,
                    'is_pending_payment' => $pendingPayment
                ]);
            });
        }, __FUNCTION__);
    }

    private function updateAccessoriesStock(Accessory $accessory): bool
    {
        return $this->run(function () use($accessory) {
            //Decreases the number of available accessories.
            $accessory->available_quantity = $accessory->available_quantity - 1;

            //In case it has reached zero, it makes it unavailable for sale automatically.
            if($accessory->available_quantity === 0)
                $accessory->available_for_sale = false;

            return $accessory->save();
        }, __FUNCTION__);
    }
}
