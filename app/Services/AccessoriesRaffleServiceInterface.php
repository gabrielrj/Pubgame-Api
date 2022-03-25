<?php

namespace App\Services;

use App\Models\Game\Settings\Accessory;
use Illuminate\Database\Eloquent\Model;

interface AccessoriesRaffleServiceInterface
{
    function returnsDrawnAccessory(Model $item) : Accessory;
}
