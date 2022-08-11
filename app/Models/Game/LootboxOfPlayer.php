<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LootboxOfPlayer extends ProductTransactionable
{
    use HasFactory, SoftDeletes;

    protected $table = 'lootbox_of_players';


}
