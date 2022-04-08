<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;

abstract class ProductTransactionable extends Model
{
    public function transaction_item(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(TransactionItem::class, 'itenable');
    }
}
