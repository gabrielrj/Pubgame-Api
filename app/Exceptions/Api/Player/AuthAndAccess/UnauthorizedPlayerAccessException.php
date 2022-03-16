<?php

namespace App\Exceptions\Api\Player\AuthAndAccess;

use Exception;

class UnauthorizedPlayerAccessException extends Exception
{
    protected $message = 'Unauthorized player access.';
}
