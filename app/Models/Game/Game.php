<?php

namespace App\Models\Game;

use App\EnumTypes\Game\ClaimStatus;
use App\EnumTypes\Game\GameStatus;
use App\Models\Game\Settings\GameType;
use App\Models\Game\Settings\PubTable;
use App\Models\Traits\HasUuidKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends ProductTransactionable
{
    use HasFactory, SoftDeletes, HasUuidKey;

    protected $table = 'games';

    protected $fillable = [
        'game_types_id',
        'players_id',
        'avatars_id',
        'avatar_level',
        'pub_tables_id',
        'number_of_avatar_accessories',
        'pub_coin_fee_to_play',
        'number_of_hits',
        'pub_coin_earned',
        'game_status',
        'claim_status',
        'claim_fee_percentage',
        'pub_coin_claimed',
    ];

    protected $hidden = [
        'id',
        'players_id',
        'avatars_id',
        'pub_tables_id',
        'game_status',
        'claim_status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'status_game'
    ];

    public function getStatusGameAttribute(): string
    {
        return match ($this->attributes['game_status']){
            GameStatus::InProgress => 'In progress.',
            GameStatus::Finished => 'Finished.',
            GameStatus::Canceled => 'Canceled.',
            default => 'Undefined.',
        };
    }

    public function getStatusClaimAttribute(): string
    {
        return match ($this->attributes['claim_status']){
            ClaimStatus::PendingCompletionGame => 'Pending game completion.',
            ClaimStatus::AwaitingClaim => 'Awaiting claim.',
            ClaimStatus::CanceledClaim => 'Claim canceled.',
            ClaimStatus::Claimed => 'Claimed.',
            default => 'Undefined.',
        };
    }

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




}
