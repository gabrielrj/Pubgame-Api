<?php

namespace App\Models\Game;

use App\Models\Errors\ErrorLog;
use App\Models\Game\Settings\CoinType;
use App\Models\Traits\HasUuidKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Player extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasUuidKey;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'wallet_address',
        'pubcoin_game_amount',
        'pubcoin_wallet_amount'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'password',
        'remember_token',
        'is_blocked',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_blocked' => 'bool'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function errors(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(ErrorLog::class, 'usenable');
    }

    public function coins(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(CoinType::class, 'players_coin_types', 'players_id', 'coin_types_id');
    }
}
