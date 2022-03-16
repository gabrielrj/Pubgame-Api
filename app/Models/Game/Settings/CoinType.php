<?php

namespace App\Models\Game\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoinType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'coin_types';

    protected $fillable = [
        'acronym',
        'name',
        'is_depositable'
    ];

    protected $hidden = ['is_depositable'];

    protected $casts = ['is_depositable' => 'bool'];
}
