<?php

namespace App\Services\Strategies\Transactions;

use App\Models\Game\Player;
use App\Models\Game\ProductTransactionable;
use App\Models\Game\Transaction;
use App\Services\RegisterTransactionServiceInterface;
use App\Services\Traits\ServiceCallableIntercept;
use App\Services\TransactionService;
use Exception;

class RegisterTransactionStrategy extends TransactionService
{
    use ServiceCallableIntercept;

    protected RegisterTransactionServiceInterface $registerTransactionService;

    public function __construct(RegisterTransactionServiceInterface $registerTransactionService)
    {
        $this->registerTransactionService = $registerTransactionService;
    }

    function createNewTransaction(Player $player,
                                  array $payload = null,
                                  ProductTransactionable ...$items): Transaction
    {
        return $this->registerTransactionService->createNewTransaction($player, $payload, ...$items);
    }
}
