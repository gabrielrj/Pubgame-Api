<?php

namespace App\Models\Game;

use App\Models\Game\Settings\Accessory;
use App\Models\Traits\HasUuidKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccessoryOfPlayer extends ProductTransactionable
{
    use HasFactory, SoftDeletes, HasUuidKey;

    protected $table = 'accessory_of_players';

    protected $fillable = [
        'accessories_id',
        'box_id',
        'players_id',
        'avatars_id',
        'engagement_date_in_avatar',
        'is_pending_payment'
    ];

    protected $hidden = [
        'id',
        'accessories_id',
        'players_id',
        'avatars_id',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'engagement_date_in_avatar'
    ];

    protected $casts = [
        'is_pending_payment' => 'bool'
    ];

    public function accessory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Accessory::class, 'accessories_id');
    }

    public function avatar(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Avatar::class, 'avatars_id');
    }

    public function player(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Player::class, 'players_id');
    }

}
