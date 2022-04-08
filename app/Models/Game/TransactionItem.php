<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaction_items';

    protected $fillable = [
        'transactions_id',
        'itenable_id',
        'itenable_type',
    ];

    protected $hidden = [
        'transactions_id',
        'itenable_id',
        'itenable_type',
    ];

    public function itenable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }
}
