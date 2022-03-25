<?php

namespace App\Services;

use App\Models\Game\Player;
use App\Models\Game\Transaction;
use Exception;
use Illuminate\Database\Eloquent\Model;

interface RegisterTransactionServiceInterface
{
    /**
     * @param Player $player
     * @param array|null $payload
     * @param Model|null $item
     * @return Transaction
     * @throws Exception
     */
    function createNewTransaction(Player $player, array $payload = null, Model $item = null) : Transaction;
}
