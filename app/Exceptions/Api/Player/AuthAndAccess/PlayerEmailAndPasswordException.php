<?php

namespace App\Exceptions\Api\Player\AuthAndAccess;

use App\Exceptions\Api\CustomException;

class PlayerEmailAndPasswordException extends CustomException
{
    protected string $key = __CLASS__;
}
