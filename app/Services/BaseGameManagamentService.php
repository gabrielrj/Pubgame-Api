<?php

namespace App\Services;

use App\EnumTypes\Game\GameStatus;
use App\Models\Game\Avatar;
use App\Models\Game\Game;
use App\Models\Game\Player;
use App\Models\Game\Settings\PubTable;
use App\Services\Repositories\AccessoryOfPlayerRepositoryInterface;
use App\Services\Repositories\AvatarRepositoryInterface;
use App\Services\Repositories\GameRepositoryInterface;
use App\Services\Traits\ServiceCallableIntercept;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseGameManagamentService
{
    use ServiceCallableIntercept;

    abstract function startNewGame(Player $player, Avatar $avatar, PubTable $table): bool;

    abstract function getLastGameStarted(Player $player, Avatar $avatar = null): ?Game;

    abstract function endGame(Player $player, Game $game, ?array $payload = []): bool;

    /**
     * @throws Exception
     */
    public function changeAvatarLastGameDateTime(Avatar $avatar, Carbon $lastGameDate) : void
    {
        $this->run(function () use ($avatar, $lastGameDate){
            $avatarRepository = app()->make(AvatarRepositoryInterface::class);

            $avatarRepository->update($avatar, ['last_game_date' => $lastGameDate]);
        }, __FUNCTION__);
    }

    /**
     * @throws Exception
     */
    public function changeAccessoriesOfAvatarLastGameDateTime(Collection $accessories, Carbon $lastGameDate) : void
    {
        $this->run(function () use ($accessories, $lastGameDate){
            if ($accessories->count() > 0){
                $accessoryRepository = app()->make(AccessoryOfPlayerRepositoryInterface::class);

                foreach ($accessories as $accessory){
                    $accessoryRepository->update($accessory, ['last_game_date' => $lastGameDate]);
                }

            }
        }, __FUNCTION__);
    }

    /**
     * @throws Exception
     */
    function getHistoryGamesByDate(Player $player, string $date, array $games = null, bool $onlyFinishedGames = true): ?Collection
    {
        return $this->run(function () use ($player, $date, $onlyFinishedGames, $games){
            if (!$dateGame = date_create_from_format('Y-m-d', $date))
                throw new \InvalidArgumentException('The date entered for search is invalid.');

            $gameRepository = app()->make(GameRepositoryInterface::class);

            $query = $gameRepository->newQuery()
                ->with(['avatar.accessories', 'type', 'pub_table'])
                ->wherePlayersId($player->id)
                ->whereDate('created_at', '=', $date);

            if($onlyFinishedGames)
                $query->whereGameStatus(GameStatus::Finished);

            if(isset($games)) {
                $query->whereHas('type', function ($query) use ($games) {
                    $query->whereIn('name', $games);
                });
            }

            return $query->get();

        }, __FUNCTION__);
    }

    /**
     * @throws Exception
     */
    function cancelsGamesThatWereStartedButNotCompleted(Player $player): void
    {
        $this->run(function () use ($player){
            $gameRepository = app()->make(GameRepositoryInterface::class);

            $gamesInProgress = $gameRepository->newQuery()
                ->wherePlayersId($player->id)
                ->whereGameStatus(GameStatus::InProgress)
                ->get();

            foreach ($gamesInProgress as $game){
                $gameRepository->update($game, ['game_status' => GameStatus::Canceled]);
            }

        }, __FUNCTION__);
    }
}
