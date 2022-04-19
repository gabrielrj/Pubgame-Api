<?php

namespace App\Exceptions\Api\Player\AuthAndAccess;

use App\Exceptions\Api\CustomException;

class PlayerEmailAlreadyRegisteredException extends CustomException
{
    protected string $key = __CLASS__;
}
