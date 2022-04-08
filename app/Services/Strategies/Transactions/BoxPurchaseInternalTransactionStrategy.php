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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class BoxPurchaseInternalTransactionStrategy extends TransactionService
{
    use ServiceCallableIntercept;

    /**
     * @param Player $player
     * @param array|null $payload ['coin_types_id', 'box_price']
     * @param Model ...$items
     * @return Transaction
     * @throws Exception
     */
    function createNewTransaction(Player $player,
                                  array $payload = null,
                                  ProductTransactionable ...$items): Transaction
    {
        return $this->run(function () use ($player, $payload, $items) {
            throw_if(!Arr::exists($payload, 'coin_types_id') || !isset($payload['coin_types_id']), new \InvalidArgumentException('It is mandatory to select which currency will be used in the transaction.'));

            throw_if(!Arr::exists($payload, 'box_price') || !isset($payload['box_price']), new \InvalidArgumentException('It is mandatory to inform the amount of coins that will be involved in this transaction.'));

            return parent::registerNewTransactionToPlayer($player,
                TransactionOperation::Debit,
                TransactionType::InternalBoxSales,
                TransactionStatus::Completed,
                $payload['box_price'],
                $payload['coin_types_id'],
                null,
                ...$items);
        }, __FUNCTION__);
    }
}
