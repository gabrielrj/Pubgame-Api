<?php

namespace App\Models\Game;

use App\Models\Game\Settings\BoxAccessoryType;
use App\Models\Traits\HasUuidKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoxOfPlayer extends Model
{
    use HasFactory, SoftDeletes, HasUuidKey;

    protected $table = 'box_of_players';

    protected $fillable = [
        'box_accessory_types_id',
        'players_id',
        'is_open',
        'accessory_id',
        'is_pending_payment'
    ];

    protected $hidden = ['id', 'box_accessory_types_id', 'players_id', 'accessory_id'];

    protected $casts = [
        'is_open' => 'bool',
        'is_pending_payment' => 'bool'
    ];

    public function type(){
        return $this->belongsTo(BoxAccessoryType::class, 'box_accessory_types_id', 'id');
    }
}
