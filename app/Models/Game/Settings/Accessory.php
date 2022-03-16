<?php

namespace App\Models\Game\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accessory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'accessories';

    protected $fillable = ['type_id', 'rarity_id', 'name', 'description', 'available_for_sale', 'available_quantity', 'is_unlimited'];

    protected $casts = ['type_id', 'rarity_id', 'available_for_sale', 'is_unlimited'];
}
