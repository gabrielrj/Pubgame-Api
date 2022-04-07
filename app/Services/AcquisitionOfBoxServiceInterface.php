<?php

namespace App\Services;

use App\Models\Game\BoxOfPlayer;
use App\Models\Game\Player;

interface AcquisitionOfBoxServiceInterface
{
    function acquisitionOfBox(Player $player, array $payload): BoxOfPlayer;
}
