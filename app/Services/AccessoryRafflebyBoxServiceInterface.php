<?php

namespace App\Services;

use App\Models\Game\Settings\Accessory;
use App\Models\Game\Settings\BoxAccessoryType;
use Illuminate\Database\Eloquent\Model;

interface AccessoryRafflebyBoxServiceInterface extends AccessoriesRaffleServiceInterface
{
    public function returnsDrawnAccessory(BoxAccessoryType|Model $item): Accessory;
}
