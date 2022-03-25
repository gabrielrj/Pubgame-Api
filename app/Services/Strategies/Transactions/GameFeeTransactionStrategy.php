<?php

namespace App\Services\Strategies\Transactions;

use App\EnumTypes\Transactions\TransactionStatus;
use App\EnumTypes\Transactions\TransactionType;
use App\Exceptions\Api\Player\PlayerCoinDebitException;
use App\Exceptions\Api\Player\Transactions\PlayerHasNoFundsException;
use App\Models\Game\Game;
use App\Models\Game\Player;
use App\Models\Game\Transaction;
use App\Services\Repositories\CoinTypeRepositoryInterface;
use App\Services\Repositories\TransactionRepositoryInterface;
use App\Services\Traits\ServiceCallableIntercept;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class GameFeeTransactionStrategy implements \App\Services\RegisterTransactionServiceInterface
{
    use ServiceCallableIntercept;

    protected TransactionRepositoryInterface $transactionRepository;
    protected CoinTypeRepositoryInterface $coinTypeRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository,
                                CoinTypeRepositoryInterface $coinTypeRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->coinTypeRepository = $coinTypeRepository;
    }


    function createNewTransaction(Player $player, array $payload = null, Model $item = null): Transaction
    {
        return $this->run(function () use($player, $payload) {
            throw_if(!Arr::exists($payload, 'coin_type') || !isset($payload['coin_type']), new \InvalidArgumentException('It is mandatory to select which currency will be used in the transaction.'));

            throw_if(!Arr::exists($payload, 'coin_amount') || !isset($payload['coin_amount']), new \InvalidArgumentException('It is mandatory to inform the amount of coins that will be involved in this transaction.'));

            $coinType = $this->coinTypeRepository->newQuery()->whereAcronym($payload['coin_type'])->first();

            throw_unless($player->checkFunds($payload['coin_amount'], $coinType->id), PlayerHasNoFundsException::class);

            $coinAmount = $payload['coin_amount'];

            $currentFundsOfPlayer = $player->getFunds($coinType->id);

            if(!$player->performsDebit($coinAmount, $coinType->id))
                throw new PlayerCoinDebitException();

            return $this->transactionRepository->create([
                'players_id' => $player->id,
                'game_current_amount_of_coins' => $currentFundsOfPlayer,
                'game_expected_amount_of_coins' => $currentFundsOfPlayer - $coinAmount,
                'coin_amount' => $coinAmount,
                'type' => TransactionType::GameFeePayment,
                'status' => TransactionStatus::Completed,
            ]);

        }, __FUNCTION__);
    }
}
