<?php

namespace App\Models\Game;

use App\Models\Traits\HasUuidKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Avatar extends Model
{
    use HasFactory, SoftDeletes, HasUuidKey;

    protected $table = 'avatars';

    protected $fillable = [
        'players_id',
        'surname',
        'cost_type',
        'box_id',
        'color',
    ];

    protected $hidden = ['id', 'box_id', 'players_id'];
}
