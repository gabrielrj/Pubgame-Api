<?php

namespace App\Services;

use App\Models\Game\Avatar;
use App\Models\Game\Player;

interface AvatarServiceInterface
{
    public function createNewAvatar(Player $player, string $costType) : Avatar;
}
