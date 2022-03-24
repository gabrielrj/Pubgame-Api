<?php

namespace App\Services;

use App\Models\Game\Avatar;
use App\Models\Game\Game;
use App\Models\Game\Player;
use App\Models\Game\Settings\PubTable;

interface GameManagementServiceInterface
{
    function startNewGame(Player $player, Avatar $avatar, PubTable $table): bool;

    function getLastGameStarted(Player $player, Avatar $avatar): ?Game;

    function endGame(Player $player, Game $game): bool;
}
