<?php

namespace App\Services;

use App\EnumTypes\Accessory\AccessoryEdition;
use App\Models\Game\Settings\Accessory;
use App\Models\Game\Settings\BoxAccessoryType;
use App\Services\Repositories\AccessoryRepositoryInterface;
use App\Services\Traits\ServiceCallableIntercept;
use Exception;

class AccessoryRaffleByBoxService implements AccessoryRaffleByBoxServiceInterface
{
    use ServiceCallableIntercept;

    protected AccessoryRepositoryInterface $aRepository;

    public function __construct(AccessoryRepositoryInterface $aRepository)
    {
        $this->aRepository = $aRepository;
    }

    /**
     * @throws Exception
     */
    public function returnsDrawnAccessory(BoxAccessoryType $boxType, bool $isFree = false): Accessory
    {
        return $this->run(function () use ($isFree, $boxType) {
            $probabilities = $boxType->probability_accessory_rarity;

            $rarityId = null;
            $totalChances = 0;

            $gameDice = random_int(1, 100);

            foreach ($probabilities as $probability) {
                $probability = (object)$probability;

                if ($totalChances == 0) {
                    if ($gameDice <= $probability->chances) {
                        $rarityId = $probability->rarity;
                        break;
                    }
                } else {
                    if ($gameDice > $totalChances && $gameDice <= ($totalChances + $probability->chances)) {
                        $rarityId = $probability->rarity;
                        break;
                    }
                }

                $totalChances = $totalChances + $probability->chances;
            }

            $accessoryQuery = $this->aRepository->newQuery()
                ->where('rarity_id', '=', $rarityId)
                ->where('is_free', '=', $isFree)
                ->where('available_for_sale', '=', true);

            if($boxType->accessory_edition == AccessoryEdition::SpecialEdition){
                $accessoryQuery->where('available_quantity', '>', 0)
                    ->where('edition', '=', $boxType->accessory_edition)
                    ->lockForUpdate();
            }

            return $accessoryQuery->inRandomOrder()->first();
        }, __FUNCTION__);
    }
}
