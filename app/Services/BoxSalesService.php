<?php

namespace App\Services;

use App\Models\Game\BoxOfPlayer;
use App\Models\Game\Player;
use App\Models\Game\Settings\BoxAccessoryType;
use App\Services\Repositories\BoxOfPlayerRepositoryInterface;
use App\Services\Traits\ServiceCallableIntercept;
use Exception;

class BoxSalesService implements BoxSalesServiceInterface
{
    use ServiceCallableIntercept;

    protected BoxOfPlayerRepositoryInterface $boxOfPlayerRepository;

    public function __construct(BoxOfPlayerRepositoryInterface $boxOfPlayerRepository)
    {
        $this->boxOfPlayerRepository = $boxOfPlayerRepository;
    }

    /**
     * @throws Exception
     */
    function performsExternalSales(Player $player, BoxAccessoryType $boxAccessoryType, string $hashTransaction): BoxOfPlayer
    {
        return $this->run(function () use($player, $boxAccessoryType, $hashTransaction) {

        }, __FUNCTION__);
    }

    /**
     * @throws Exception
     */
    function performsInternalSales(Player $player, BoxAccessoryType $boxAccessoryType): BoxOfPlayer
    {
        return $this->run(function () use($player, $boxAccessoryType) {

        }, __FUNCTION__);
    }
}
