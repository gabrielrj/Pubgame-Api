<?php

namespace App\Models\Game\Settings;

use Database\Factories\SkillFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'skills';

    protected $fillable = ['name', 'description', 'code'];

    protected $hidden = ['id'];

    /**
     * @return SkillFactory
     */
    protected static function newFactory(): SkillFactory
    {
        return SkillFactory::new();
    }
}
