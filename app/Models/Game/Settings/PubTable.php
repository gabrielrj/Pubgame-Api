<?php

namespace App\Models\Game\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PubTable extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pub_tables';

    protected $fillable = ['name', 'description', 'beer_poing_settings'];

    protected $hidden = ['beer_poing_settings'];

    protected $casts = ['beer_poing_settings' => 'array'];
}
