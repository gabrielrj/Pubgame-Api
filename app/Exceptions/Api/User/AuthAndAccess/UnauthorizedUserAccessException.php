<?php

namespace App\Exceptions\Api\User\AuthAndAccess;

use Exception;

class UnauthorizedUserAccessException extends Exception
{
    protected $code = 401;

    protected $message = 'Unauthorized user access.';
}
