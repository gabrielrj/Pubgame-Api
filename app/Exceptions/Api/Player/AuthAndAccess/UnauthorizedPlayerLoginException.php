<?php

namespace App\Exceptions\Api\Player\AuthAndAccess;

use Exception;

class UnauthorizedPlayerLoginException extends Exception
{
    protected string $key = __CLASS__;

    protected $code = 401;
}
