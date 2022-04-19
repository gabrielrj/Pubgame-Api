<?php

namespace App\Exceptions\Api\User\AuthAndAccess;

use App\Exceptions\Api\CustomException;

class UnauthorizedUserAccessException extends CustomException
{
    protected string $key = __CLASS__;

    protected $code = 401;
}
