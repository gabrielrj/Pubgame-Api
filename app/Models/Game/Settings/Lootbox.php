<?php

namespace App\Models\Game\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lootbox extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lootboxes';

    protected $fillable = [
        'id',
        'name',
        'description',
        'available_for_sale',
        'start_of_availability',
        'end_of_availability',
        'quantity_made_available',
        'remaining_amount',
        'price',
        'price_coin_id',
    ];

    protected $hidden = [
        'price_coin_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //Relationships//
    public function coin_type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CoinType::class, 'price_coin_id');
    }
}
