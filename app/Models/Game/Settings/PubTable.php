<?php

namespace App\Models\Game\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PubTable extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pub_tables';

    protected $fillable = ['name', 'description', 'beer_poing_settings'];

    protected $hidden = ['beer_poing_settings'];

    protected $casts = ['beer_poing_settings' => 'array'];

    /***
     * Format of beer_poing_settings param
     *
     * 'beer_poing_settings' => [
            ['avatar_level' => 'Common', 'table_fee' => 7, 'value_per_ball' => 3.1, 'max_accessories_count' => 6, 'modifier_percentage_per_accessory' => 12],
            ['avatar_level' => 'Rare', 'table_fee' => 20, 'value_per_ball' => 5.5, 'max_accessories_count' => 6, 'modifier_percentage_per_accessory' => 10],
            ['avatar_level' => 'Epic', 'table_fee' => 30, 'value_per_ball' => 9.5, 'max_accessories_count' => 6, 'modifier_percentage_per_accessory' => 8],
            ['avatar_level' => 'Legendary', 'table_fee' => 50, 'value_per_ball' => 20, 'max_accessories_count' => 6, 'modifier_percentage_per_accessory' => 0],
        ]
     *
     *
     */
}
