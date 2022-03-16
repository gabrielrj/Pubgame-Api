<?php

namespace App\Exceptions\Api\Player\AuthAndAccess;

use Exception;

class UnauthorizedPlayerLoginException extends Exception
{
    protected $message = 'Unauthorized player login.';
}
