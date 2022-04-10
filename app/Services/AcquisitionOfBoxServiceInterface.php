<?php

namespace App\Services;

use App\Models\Game\Player;
use App\Models\Game\Settings\BoxAccessoryType;

interface AcquisitionOfBoxServiceInterface
{
    function acquisitionOfBox(Player $player, array $payload);

    function performsWriteOffInTheInventoryOfBoxes(BoxAccessoryType $boxAccessoryType) : bool;
}
