<?php

namespace App\Models\Errors;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'function',
        'exception',
        'message',
        'stack',
        'usenable_id',
        'usenable_type',
    ];

    protected $hidden = [
        'usenable_id',
        'usenable_type',
    ];

    public function usenable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }
}
