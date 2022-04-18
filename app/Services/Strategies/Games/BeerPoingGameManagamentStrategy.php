<?php

namespace App\Services\Strategies\Games;

use App\EnumTypes\Coin\CoinTypes;
use App\EnumTypes\Game\ClaimStatus;
use App\EnumTypes\Game\GameStatus;
use App\Exceptions\Api\FeatureNotImplementedException;
use App\Exceptions\Api\Game\AvatarMaxAccessoriesException;
use App\Exceptions\Api\Player\Avatar\AvatarIsNotThePlayerException;
use App\Models\Game\Avatar;
use App\Models\Game\Game;
use App\Models\Game\Player;
use App\Models\Game\Settings\PubTable;
use App\Services\GameManagementServiceInterface;
use App\Services\Repositories\GameRepositoryInterface;
use App\Services\Repositories\GameTypeRepositoryInterface;
use App\Services\Strategies\Transactions\GameFeeTransactionStrategy;
use App\Services\Strategies\Transactions\RegisterTransactionStrategy;
use App\Services\Traits\ServiceCallableIntercept;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class BeerPoingGameManagamentStrategy implements GameManagementServiceInterface
{
    use ServiceCallableIntercept;

    protected GameRepositoryInterface $gameRepository;
    protected GameTypeRepositoryInterface $gameTypeRepository;

    public function __construct(GameRepositoryInterface $gameRepository, GameTypeRepositoryInterface $gameTypeRepository)
    {
        $this->gameRepository = $gameRepository;
        $this->gameTypeRepository = $gameTypeRepository;
    }

    /**
     * @throws Exception
     */
    function startNewGame(Player $player, Avatar $avatar, PubTable $table): bool
    {
        return $this->run(function () use ($player, $avatar, $table){
            throw_if($avatar->players_id != $player->id, AvatarIsNotThePlayerException::class);

            $tableSettingForAvatar = (object)Arr::where($table->beer_poing_settings, function ($value) use($avatar){
                return $value['avatar_level'] == $avatar->level;
            });

            $tableFee = (float)$tableSettingForAvatar->table_fee;

            $accessoriesCount = $avatar->accessories()->count();

            $maxAccessoriesTable = (int)$tableSettingForAvatar->max_accessories_count;

            throw_if($accessoriesCount > $maxAccessoriesTable, new AvatarMaxAccessoriesException("The maximum amount of accessories per avatar for the selected table is $maxAccessoriesTable"));

            $transactionService = (new RegisterTransactionStrategy(app()->make(GameFeeTransactionStrategy::class)));

            $gameTypeId = $this->gameTypeRepository->newQuery()->whereName('Beer Poing')->first()->id;

            return DB::transaction(function () use ($player, $gameTypeId, $tableFee, $avatar, $table, $accessoriesCount, $transactionService) {
                //$gameFeeTransaction = $transactionService->createNewTransaction($player, ['coin_amount' => $tableFee, 'coin_type' => CoinTypes::PubBeerCoin]);

                $newGame = $this->gameRepository->newQuery()->create([
                    'game_types_id' => $gameTypeId,
                    'players_id' => $player->id,
                    'avatars_id' => $avatar->id,
                    'avatar_level' => $avatar->level,
                    'pub_tables_id' => $table->id,
                    'number_of_avatar_accessories' => $accessoriesCount,
                    'pub_coin_fee_to_play' => $tableFee,
                    'game_status' => GameStatus::InProgress,
                    'claim_status' => ClaimStatus::PendingCompletionGame,
                ]);

                //$newGame?->transactions()->save($gameFeeTransaction);

                $gameFeeTransaction = $transactionService->createNewTransaction(
                    $player,
                    ['coin_amount' => $tableFee, 'coin_type' => CoinTypes::PubBeerCoin],
                    $newGame
                );

                return isset($newGame);
            });


        }, __FUNCTION__);
    }

    /**
     * @throws Exception
     */
    function getLastGameStarted(Player $player, ?Avatar $avatar): ?Game
    {
        return $this->run(function () use ($player, $avatar){
            $query = $this->gameRepository->newQuery()
                ->where('players_id', '=', $player->id);

            if($avatar)
                $query->where('avatars_id', '=', $avatar->id);

            return $query->where('game_status', '=', GameStatus::InProgress)
                ->latest('created_at')
                ->first();
        }, __FUNCTION__);
    }

    /**
     * @throws Exception
     */
    function endGame(Player $player, Game $game): bool
    {
        return $this->run(function () use ($player, $game){
            throw new FeatureNotImplementedException();
        }, __FUNCTION__);
    }

    /**
     * @throws Exception
     */
    function getHistoryGamesByDate(Player $player, string $date): Collection
    {
        return $this->run(function () use ($player, $date){
            throw new FeatureNotImplementedException();
        }, __FUNCTION__);
    }
}
