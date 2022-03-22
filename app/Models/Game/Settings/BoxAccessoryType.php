<?php

namespace App\Models\Game\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoxAccessoryType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'box_accessory_types';

    protected $fillable = ['name', 'description', 'cost_type', 'contains_avatar', 'price', 'price_coin_id', 'probability_accessory_rarity'];

    protected $hidden = ['contains_avatar', 'price_coin_id', 'probability_accessory_rarity'];

    protected $casts = ['contains_avatar' => 'bool'];

    //Relationships//
    public function coin(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CoinType::class, 'price_coin_id');
    }
}
