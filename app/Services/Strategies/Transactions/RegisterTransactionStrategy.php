<?php

namespace App\Services\Strategies\Transactions;

use App\Models\Game\Player;
use App\Models\Game\Transaction;
use App\Services\RegisterTransactionServiceInterface;
use Illuminate\Database\Eloquent\Model;

class RegisterTransactionStrategy implements \App\Services\RegisterTransactionServiceInterface
{
    protected RegisterTransactionServiceInterface $registerTransactionService;

    public function __construct(RegisterTransactionServiceInterface $registerTransactionService)
    {
        $this->registerTransactionService = $registerTransactionService;
    }

    function createNewTransaction(Player $player, array $payload, Model $item = null): Transaction
    {
        return $this->registerTransactionService->createNewTransaction($player, $payload, $item);
    }
}
