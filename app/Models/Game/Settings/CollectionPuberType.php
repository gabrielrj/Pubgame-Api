<?php

namespace App\Models\Game\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollectionPuberType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'collection_puber_types';

    protected $fillable = [
        'name',
        'description',
        'accessory_collections_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'accessory_collections_id',
    ];
}
