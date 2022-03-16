<?php

namespace App\Models\Game\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccessoryRarityType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'accessory_rarity_types';

    protected $fillable = ['id', 'name', 'description'];
}
