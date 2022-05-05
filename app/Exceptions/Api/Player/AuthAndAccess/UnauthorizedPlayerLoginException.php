<?php

namespace App\Exceptions\Api\Player\AuthAndAccess;

use App\Exceptions\Api\CustomException;

class UnauthorizedPlayerLoginException extends CustomException
{
    protected string $key = __CLASS__;

    protected $code = 401;
}
