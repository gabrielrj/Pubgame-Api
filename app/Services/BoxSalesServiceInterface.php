<?php

namespace App\Services;

use App\Models\Game\BoxOfPlayer;
use App\Models\Game\Player;
use App\Models\Game\Settings\BoxAccessoryType;

interface BoxSalesServiceInterface
{
    function performsExternalSales(Player $player,
                                   BoxAccessoryType $boxAccessoryType,
                                   string $hashTransaction) : BoxOfPlayer;

    function performsInternalSales(Player $player,
                                   BoxAccessoryType $boxAccessoryType): BoxOfPlayer;
}
