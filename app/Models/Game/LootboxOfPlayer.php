<?php

namespace App\Models\Game;

use App\Models\Game\Settings\Lootbox;
use App\Models\Game\Settings\LootboxItem;
use App\Models\Traits\HasUuidKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LootboxOfPlayer extends ProductTransactionable
{
    use HasFactory, SoftDeletes, HasUuidKey;

    protected $table = 'lootbox_of_players';

    protected $fillable = [
        'lootboxes_id',
        'players_id',
        'is_open',
        'purchase_status',
        'lootbox_items_id',
        'is_pending_payment'
    ];

    protected $hidden = [
        'id',
        'lootboxes_id',
        'players_id',
        'lootbox_items_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'is_open' => 'bool',
        'is_pending_payment' => 'bool'
    ];

    public function lootbox_type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Lootbox::class, 'lootboxes_id');
    }

    public function raffled_item(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LootboxItem::class, 'lootbox_items_id');
    }

    public function item(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(LootboxItemOfPlayer::class, 'lootbox_of_players_id', 'id');
    }
}
