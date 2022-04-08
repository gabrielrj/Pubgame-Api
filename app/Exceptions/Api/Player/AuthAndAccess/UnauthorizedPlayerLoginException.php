<?php

namespace App\Exceptions\Api\Player\AuthAndAccess;

use Exception;

class UnauthorizedPlayerLoginException extends Exception
{
    protected $code = 401;

    protected $message = 'Unauthorized player login.';
}
