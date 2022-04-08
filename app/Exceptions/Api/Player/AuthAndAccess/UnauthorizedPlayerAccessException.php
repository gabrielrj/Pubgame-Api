<?php

namespace App\Exceptions\Api\Player\AuthAndAccess;

use Exception;

class UnauthorizedPlayerAccessException extends Exception
{
    protected $code = 401;

    protected $message = 'Unauthorized player access.';
}
