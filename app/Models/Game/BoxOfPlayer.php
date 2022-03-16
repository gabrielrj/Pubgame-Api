<?php

namespace App\Models\Game;

use App\Models\Traits\HasUuidKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoxOfPlayer extends Model
{
    use HasFactory, SoftDeletes, HasUuidKey;

    protected $table = 'box_of_players';

    protected $fillable = [
        'box_accessory_types_id',
        'players_id',
        'is_open',
        'accessory_id',
    ];

    protected $hidden = ['id', 'box_accessory_types_id', 'players_id', 'accessory_id'];

    protected $casts = ['is_open'];
}
