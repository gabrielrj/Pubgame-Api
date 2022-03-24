<?php

namespace App\Models\Game;

use App\Models\Game\Settings\GameType;
use App\Models\Game\Settings\PubTable;
use App\Models\Traits\HasUuidKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use HasFactory, SoftDeletes, HasUuidKey;

    protected $table = 'games';

    protected $fillable = [
        'game_types_id',
        'players_id',
        'avatars_id',
        'pub_tables_id',
        'number_of_avatar_accessories',
        'pub_coin_fee_to_play',
        'number_of_hits',
        'pub_coin_earned',
        'game_status',
        'claim_status',
        'claim_fee_percentage',
        'pub_coin_claimed'
    ];

    protected $hidden = [
        'id',
        'players_id',
        'avatars_id',
        'pub_tables_id',
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
    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(GameType::class, 'game_types_id');
    }

    public function player(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Player::class, 'players_id');
    }

    public function avatar(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Avatar::class, 'avatars_id');
    }

    public function pub_table(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PubTable::class, 'pub_tables_id');
    }

    public function transactions(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Transaction::class, 'itenable');
    }


}
