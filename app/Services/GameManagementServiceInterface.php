<?php

namespace App\Services;

use App\Models\Game\Avatar;
use App\Models\Game\Game;
use App\Models\Game\Player;
use App\Models\Game\Settings\PubTable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

interface GameManagementServiceInterface
{
    function startNewGame(Player $player, Avatar $avatar, PubTable $table): bool;

    function getLastGameStarted(Player $player, ?Avatar $avatar): ?Game;

    function endGame(Player $player, Game $game, ?array $payload = []): bool;

    function getHistoryGamesByDate(Player $player, string $date): Collection;

    function changeAvatarLastGameDateTime(Avatar $avatar, Carbon $lastGameDate) : void;

    function changeAccessoriesOfAvatarLastGameDateTime(Collection $accessories, Carbon $lastGameDate) : void;
}
