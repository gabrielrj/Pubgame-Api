<?php

namespace App\Services;

use App\Models\Game\Settings\Lootbox;
use App\Services\Traits\ServiceCallableIntercept;
use Illuminate\Database\Eloquent\Collection;

class LootboxManagerService
{
    use ServiceCallableIntercept;

    /**
     * @throws \Exception
     */
    public function getAllLootboxesAvailableForSale() : Collection
    {
        return $this->run(function () {
            $now = now();

            return Lootbox::query()
                ->where('available_for_sale', '=', true)
                ->whereDate('start_of_availability', '<=', $now)
                ->whereDate('end_of_availability', '>=', $now)
                ->latest()
                ->get();
        }, __FUNCTION__);
    }

    /**
     * @throws \Exception
     */
    public function getThePreorderLootbox(): ?Lootbox
    {
        return $this->run(function () {
            $now = now();

            return Lootbox::query()
                ->where('available_for_sale', '=', true)
                ->whereDate('start_of_availability', '<=', $now)
                ->whereDate('end_of_availability', '>=', $now)
                ->latest()
                ->first();
        }, __FUNCTION__);
    }

    /**
     * @throws \Exception
     */
    public function findLootboxInfoById(int $id): Lootbox
    {
        return $this->run(function () use ($id){
            return Lootbox::query()->find($id);
        }, __FUNCTION__);
    }

    /**
     * @throws \Exception
     */
    public function findLootboxInfoByName(string $name): Lootbox
    {
        return $this->run(function () use ($name){
            return Lootbox::query()->whereName($name)->first();
        }, __FUNCTION__);
    }
}
