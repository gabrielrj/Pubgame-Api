<?php

namespace App\Services;

use App\Models\Game\AccessoryOfPlayer;
use App\Models\Game\Player;
use App\Models\Game\Settings\Accessory;

interface AccessoryServiceInterface
{
    function createNewAccessoryToPlayer(Player $player, Accessory $accessory, bool $pendingPayment = false): AccessoryOfPlayer;
}
