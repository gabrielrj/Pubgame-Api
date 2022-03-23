<?php

namespace App\Services;

use App\Models\Game\Player;
use App\Models\Game\Transaction;
use Illuminate\Database\Eloquent\Model;

interface RegisterTransactionServiceInterface
{
    function createNewTransaction(Player $player, array $payload, Model $item = null) : Transaction;
}
