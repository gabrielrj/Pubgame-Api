<?php

namespace App\Models\Game\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoxAccessoryType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'box_accessory_types';

    protected $fillable = [
        'name',
        'description',
        'cost_type',
        'contains_avatar',
        'price',
        'price_coin_id',
        'probability_accessory_rarity',
        'available_for_sale',
        'is_unlimited',
        'quantity_for_sale',
    ];

    protected $hidden = [
        'contains_avatar',
        'price_coin_id',
        'probability_accessory_rarity',
        'created_at',
        'updated_at',
        'deleted_at',
        'quantity_of_raffle_accessories',
        'accessory_edition',
        'cost_type',
    ];

    protected $casts = [
        'probability_accessory_rarity' => 'array',
        'contains_avatar' => 'bool',
        'available_for_sale' => 'bool',
        'is_unlimited' => 'bool'
    ];

    //Relationships//
    public function coin_type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CoinType::class, 'price_coin_id');
    }
}
