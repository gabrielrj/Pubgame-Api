<?php

namespace App\Models\Game\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LootboxItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lootbox_items';

    protected $fillable = [
        'lootboxes_id',
        'name',
        'description',
        'available_for_sale',
        'quantity_made_available',
        'remaining_amount',
        'probability_percentage',
    ];

    protected $hidden = [
        'lootboxes_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //Relationships
    public function lootbox_type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Lootbox::class, 'lootboxes_id');
    }
}
