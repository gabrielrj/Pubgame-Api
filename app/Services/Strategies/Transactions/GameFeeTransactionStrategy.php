<?php

namespace App\Services\Strategies\Transactions;

use App\EnumTypes\Transactions\TransactionOperation;
use App\EnumTypes\Transactions\TransactionStatus;
use App\EnumTypes\Transactions\TransactionType;
use App\Exceptions\Api\Player\PlayerCoinDebitException;
use App\Exceptions\Api\Player\Transactions\PlayerHasNoFundsException;
use App\Models\Game\Player;
use App\Models\Game\ProductTransactionable;
use App\Models\Game\Transaction;
use App\Services\Repositories\CoinTypeRepositoryInterface;
use App\Services\Traits\ServiceCallableIntercept;
use App\Services\TransactionService;
use Exception;
use Illuminate\Support\Arr;

class GameFeeTransactionStrategy extends TransactionService
{
    use ServiceCallableIntercept;

    protected CoinTypeRepositoryInterface $coinTypeRepository;

    public function __construct(CoinTypeRepositoryInterface $coinTypeRepository)
    {
        $this->coinTypeRepository = $coinTypeRepository;
    }


    /**
     * @throws Exception
     */
    function createNewTransaction(Player                 $player,
                                  array                  $payload = null,
                                  ProductTransactionable ...$items): Transaction
    {
        return $this->run(function () use($player, $payload, $items) {
            throw_if(!Arr::exists($payload, 'coin_type') || !isset($payload['coin_type']), new \InvalidArgumentException('It is mandatory to select which currency will be used in the transaction.'));

            throw_if(!Arr::exists($payload, 'coin_amount') || !isset($payload['coin_amount']), new \InvalidArgumentException('It is mandatory to inform the amount of coins that will be involved in this transaction.'));

            $coinType = $this->coinTypeRepository->newQuery()->whereAcronym($payload['coin_type'])->first();

            return parent::registerNewTransactionToPlayer($player,
                TransactionOperation::Debit,
                TransactionType::GameFeePayment,
                TransactionStatus::Completed,
                $payload['coin_amount'],
                $coinType->id,
                null,
                ...$items);


        }, __FUNCTION__);
    }
}
