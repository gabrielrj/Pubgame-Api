<?php

namespace App\Services\Strategies\Games;

use App\Models\Game\Avatar;
use App\Models\Game\Game;
use App\Models\Game\Player;
use App\Models\Game\Settings\PubTable;
use App\Services\BaseGameManagamentService;
use App\Services\GameManagementServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class GameManagementStrategy extends BaseGameManagamentService
{
    protected BaseGameManagamentService|null $gameManagementService;

    public function __construct(BaseGameManagamentService|null $gameManagementService = null)
    {
        $this->gameManagementService = $gameManagementService;
    }

    function startNewGame(Player $player, Avatar $avatar, PubTable $table): bool
    {
        return $this->gameManagementService?->startNewGame($player, $avatar, $table);
    }

    function getLastGameStarted(Player $player, Avatar $avatar = null): ?Game
    {
        return $this->gameManagementService?->getLastGameStarted($player, $avatar);
    }

    function endGame(Player $player, Game $game, ?array $payload = []): bool
    {
        return $this->gameManagementService?->endGame($player, $game, $payload);
    }



}
