<?php

namespace App\Services\Strategies\Games;

use App\EnumTypes\Coin\CoinTypes;
use App\EnumTypes\Game\ClaimStatus;
use App\EnumTypes\Game\GameStatus;
use App\Exceptions\Api\FeatureNotImplementedException;
use App\Exceptions\Api\Game\AvatarGameTimeLimitException;
use App\Exceptions\Api\Game\AvatarMaxAccessoriesForTableException;
use App\Exceptions\Api\Game\NoGameStartedException;
use App\Exceptions\Api\Player\Avatar\AvatarIsNotThePlayerException;
use App\Models\Game\Avatar;
use App\Models\Game\Game;
use App\Models\Game\Player;
use App\Models\Game\Settings\PubTable;
use App\Services\BaseGameManagamentService;
use App\Services\Repositories\AvatarRepositoryInterface;
use App\Services\Repositories\GameRepositoryInterface;
use App\Services\Repositories\GameTypeRepositoryInterface;
use App\Services\Strategies\Transactions\GameFeeTransactionStrategy;
use App\Services\Strategies\Transactions\RegisterTransactionStrategy;
use App\Services\Traits\ServiceCallableIntercept;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class BeerPoingGameManagamentStrategy extends BaseGameManagamentService
{
    use ServiceCallableIntercept;

    protected GameRepositoryInterface $gameRepository;
    protected GameTypeRepositoryInterface $gameTypeRepository;

    public function __construct(GameRepositoryInterface $gameRepository,
                                GameTypeRepositoryInterface $gameTypeRepository)
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

            throw_if(($avatar->last_game_date != null && now()->diffInHours(Carbon::createFromFormat('Y-m-d H:i:s', $avatar->last_game_date)) < 24), AvatarGameTimeLimitException::class);

            $tableSettingForAvatar = (object)Arr::where($table->beer_poing_settings, function ($value) use($avatar){
                return $value['avatar_level'] == $avatar->level;
            })[0];

            $tableFee = (float)$tableSettingForAvatar->table_fee;

            $accessoriesCount = $avatar->accessories()->count();

            $maxAccessoriesTable = (int)$tableSettingForAvatar->max_accessories_count;

            throw_if($accessoriesCount > $maxAccessoriesTable, AvatarMaxAccessoriesForTableException::class);

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

                parent::changeAvatarLastGameDateTime($avatar, $newGame->created_at);

                parent::changeAccessoriesOfAvatarLastGameDateTime($avatar->accessories()->get(), $newGame->created_at);

                //$newGame?->transactions()->save($gameFeeTransaction);

                $transactionService->createNewTransaction(
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

            return $query->latest('created_at')->first();
        }, __FUNCTION__);
    }

    /**
     * @throws Exception
     */
    function endGame(Player $player, Game $game, ?array $payload = []): bool
    {
        return $this->run(function () use ($player, $game, $payload){
            throw_if($game->game_status != GameStatus::InProgress, NoGameStartedException::class);

            $totalNumberOfCorrectBalls = (int)$payload['total_balls'];


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
