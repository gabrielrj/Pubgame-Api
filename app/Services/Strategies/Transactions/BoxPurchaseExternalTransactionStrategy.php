<?php

namespace App\Services\Strategies\Transactions;

use App\EnumTypes\Transactions\TransactionOperation;
use App\EnumTypes\Transactions\TransactionStatus;
use App\EnumTypes\Transactions\TransactionType;
use App\Models\Game\Player;
use App\Models\Game\ProductTransactionable;
use App\Models\Game\Transaction;
use App\Services\Traits\ServiceCallableIntercept;
use App\Services\TransactionService;
use Exception;
use Illuminate\Support\Arr;

class BoxPurchaseExternalTransactionStrategy extends TransactionService
{
    use ServiceCallableIntercept;

    /**
     * @throws Exception
     */
    function createNewTransaction(Player $player,
                                  array $payload = null,
                                  ProductTransactionable ...$items): Transaction
    {
        return $this->run(function () use ($player, $payload, $items) {
            throw_if(!Arr::exists($payload, 'hash_transaction') || !isset($payload['hash_transaction']), new \InvalidArgumentException('It is mandatory to send the hash of the value transfer transaction carried out by the Ethereum blockchain.'));

            return parent::registerNewTransactionToPlayer($player,
                TransactionOperation::Debit,
                TransactionType::ExternalBoxSales,
                TransactionStatus::Pending,
                null,
                null,
                $payload['hash_transaction'],
                ...$items);
        }, __FUNCTION__);
    }
}
