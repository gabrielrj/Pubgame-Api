<?php

namespace App\Services;

use App\Exceptions\Api\FeatureNotImplementedException;
use App\Models\Game\Finance\Withdrawal;
use App\Models\Game\Player;
use App\Models\Game\Settings\CoinType;
use App\Services\Traits\ServiceCallableIntercept;

class WithdrawalService
{
    use ServiceCallableIntercept;

    /**
     * @throws \Exception
     */
    public function withdrawal(Player $player, CoinType $coinType, float $amount) : ?Withdrawal
    {
        return $this->run(function() use($player, $coinType, $amount){
            throw new FeatureNotImplementedException();
        }, __FUNCTION__);
    }
}
