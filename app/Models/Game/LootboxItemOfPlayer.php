<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LootboxItemOfPlayer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lootbox_items_of_players';

    protected $fillable = [

    ];
}
