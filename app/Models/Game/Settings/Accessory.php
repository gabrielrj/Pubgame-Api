<?php

namespace App\Models\Game\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accessory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'accessories';

    protected $fillable = ['type_id', 'rarity_id', 'name', 'description', 'available_for_sale', 'available_quantity', 'is_unlimited', 'skills_id', 'modifier'];

    protected $hidden = ['type_id', 'rarity_id', 'skills_id', 'available_for_sale', 'is_unlimited'];

    protected $casts = ['is_free' => 'bool', 'is_unlimited' => 'bool', 'available_for_sale' => 'bool'];

    //Relationships//
    public function skill(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Skill::class, 'skills_id');
    }
}
