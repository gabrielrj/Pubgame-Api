<?php

namespace App\Models\Game\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoxAccessoryRarityType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'box_accessory_rarity_types';

    protected $fillable = ['name', 'description', 'probability_accessory_rarity'];

    protected $hidden = ['id', 'probability_accessory_rarity'];

    protected $casts = ['probability_accessory_rarity' => 'array'];
}
