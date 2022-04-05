<?php

namespace App\Services;

use App\Models\Game\Settings\Accessory;
use App\Models\Game\Settings\BoxAccessoryType;

interface AccessoryRaffleByBoxServiceInterface
{
    public function returnsDrawnAccessory(BoxAccessoryType $boxType, bool $isFree = false): Accessory;
}
