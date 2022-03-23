<?php

namespace App\Models\Game;

use App\Models\Game\Settings\CoinType;
use App\Models\Traits\HasUuidKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes, HasUuidKey;

    protected $table = 'transactions';

    protected $fillable = [
        'players_id',
        'source_wallet',
        'destination_wallet',
        'blockchain_hash_transaction',
        'game_current_amount_of_coins',
        'game_expected_amount_of_coins',
        'coin_amount',
        'coin_types_id',
        'fee_amount',
        'fee_percentage',
        'type',
        'status',
        'itenable_id',
        'itenable_type'
    ];

    protected $hidden = [
        'id',
        'players_id',
        'source_wallet',
        'destination_wallet',
        'blockchain_hash_transaction',
        'coin_types_id',
        'game_current_amount_of_coins',
        'itenable_id',
        'itenable_type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    //Relationships//
    public function coin(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CoinType::class, 'coin_types_id');
    }

    public function itenable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }
}
