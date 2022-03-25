<?php

namespace App\Services\Strategies\Transactions;

use App\EnumTypes\Transactions\TransactionStatus;
use App\EnumTypes\Transactions\TransactionType;
use App\Exceptions\Api\FeatureNotImplementedException;
use App\Exceptions\Api\Player\PlayerCoinDebitException;
use App\Exceptions\Api\Player\Transactions\PlayerHasNoFundsException;
use App\Models\Game\Player;
use App\Models\Game\Transaction;
use App\Services\Repositories\TransactionRepositoryInterface;
use App\Services\Traits\ServiceCallableIntercept;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class BoxPurchaseInternalTransactionStrategy implements \App\Services\RegisterTransactionServiceInterface
{
    use ServiceCallableIntercept;

    protected TransactionRepositoryInterface $transactionRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * @throws Exception
     */
    function createNewTransaction(Player $player, array $payload = null, Model $item = null): Transaction
    {
        return $this->run(function () use ($player, $payload, $item) {
            throw_if(!Arr::exists($payload, 'coin_types_id') || !isset($payload['coin_types_id']), new \InvalidArgumentException('It is mandatory to select which currency will be used in the transaction.'));

            throw_if(!Arr::exists($payload, 'box_price') || !isset($payload['box_price']), new \InvalidArgumentException('It is mandatory to inform the amount of coins that will be involved in this transaction.'));

            throw_unless($player->checkFunds($payload['box_price'], $payload['coin_types_id']), PlayerHasNoFundsException::class);

            $boxPrice = $payload['box_price'];

            $currentFundsOfPlayer = $player->getFunds($payload['coin_types_id']);

            if(!$player->performsDebit($boxPrice, $payload['coin_types_id']))
                throw new PlayerCoinDebitException();

            return $this->transactionRepository->create([
                'players_id' => $player->id,
                'game_current_amount_of_coins' => $currentFundsOfPlayer,
                'game_expected_amount_of_coins' => $currentFundsOfPlayer - $boxPrice,
                'coin_amount' => $boxPrice,
                'type' => TransactionType::InternalBoxSales,
                'status' => TransactionStatus::Completed,
            ]);
        }, __FUNCTION__);
    }
}
