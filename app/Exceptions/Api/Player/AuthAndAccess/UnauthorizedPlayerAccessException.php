<?php

namespace App\Exceptions\Api\Player\AuthAndAccess;

use App\Exceptions\Api\CustomException;

class UnauthorizedPlayerAccessException extends CustomException
{
    protected string $key = __CLASS__;

    protected $code = 401;
}
