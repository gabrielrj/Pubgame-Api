<?php

namespace App\Services;

use App\Models\Game\Player;
use App\Models\Game\ProductTransactionable;
use App\Models\Game\Transaction;

interface RegisterTransactionServiceInterface
{
    function createNewTransaction(Player $player,
                                  array $payload = null,
                                  ProductTransactionable ...$items) : Transaction;
}
