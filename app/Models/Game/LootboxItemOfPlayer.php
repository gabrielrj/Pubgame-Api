<?php

namespace App\Models\Game;

use App\Models\Traits\HasUuidKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LootboxItemOfPlayer extends Model
{
    use HasFactory, SoftDeletes, HasUuidKey;

    protected $table = 'lootbox_items_of_players';

    protected $fillable = [
        'lootbox_items_id',
        'lootbox_of_players_id',
    ];

    protected $hidden = [
        'id',
        'lootbox_items_id',
        'lootbox_of_players_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
