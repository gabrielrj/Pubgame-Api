<?php

namespace App\Models\Game\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccessoryType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'accessory_types';

    protected $fillable = ['name', 'description', 'is_free'];

    protected $hidden = ['id', 'is_free'];

    protected $casts = ['is_free' => 'bool'];
}
