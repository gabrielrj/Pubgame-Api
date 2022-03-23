<?php

namespace App\Models\Game;

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
        'pub_coin_fee_to_play',
        'number_of_hits',
        'pub_coin_earned',
        'game_status',
        'claim_status',
        'claim_fee_percentage',
        'pub_coin_claimed'
    ];
}
