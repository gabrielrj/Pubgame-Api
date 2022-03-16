<?php

namespace App\Services;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

interface ErrorTrappingServiceInterface
{
    function logNewErrorException(string $file,
                                  string $function,
                                  string $exception,
                                  string $message,
                                  string $stack,
                                  ?Authenticatable $user): bool;
}
