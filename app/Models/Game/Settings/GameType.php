<?php

namespace App\Models\Game\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GameType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'game_types';

    protected $fillable = ['name', 'description'];
}
