<?php

namespace App\Models\Game;

use App\Models\Traits\HasUuidKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccessoryOfPlayer extends Model
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

    protected $hidden = ['id', 'accessories_id', 'players_id', 'avatars_id'];

    protected $dates = ['engagement_date_in_avatar'];

    protected $casts = ['is_pending_payment' => 'bool'];
}
