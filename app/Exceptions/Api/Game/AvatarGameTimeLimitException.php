<?php

namespace App\Exceptions\Api\Game;

use App\Exceptions\Api\CustomException;

class AvatarGameTimeLimitException extends CustomException
{
    protected $code = 422;

    protected string $key = __CLASS__;
}
