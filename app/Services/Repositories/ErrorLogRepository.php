<?php

namespace App\Services\Repositories;

use App\Models\Errors\ErrorLog;

class ErrorLogRepository extends BaseRepository implements ErrorLogRepositoryInterface
{
    protected string $modelClass = ErrorLog::class;
}
