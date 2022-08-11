<?php

namespace App\Services;

use App\Models\Game\Finance\Deposit;
use App\Models\Game\Player;
use App\Models\Game\Settings\CoinType;
use App\Services\Traits\ServiceCallableIntercept;

class DepositService
{
    use ServiceCallableIntercept;

    /**
     * @throws \Exception
     */
    public function deposit(Player $player, CoinType $coinType, float $amount) : ?Deposit
    {
        return $this->run(function() use($player, $coinType, $amount){
            return Deposit::query()
                ->create([
                    'players_id' => $player->id,
                    'coin_types_id' => $coinType->id,
                    'amount' => $amount
                ]);
        }, __FUNCTION__);
    }
}
