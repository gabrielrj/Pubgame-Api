<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait HasUuidKey
{
    protected static function bootHasUuidKey()
    {
        static::creating(function($query) {
            $query->uuid = (string)Str::uuid();
        });
    }
}
