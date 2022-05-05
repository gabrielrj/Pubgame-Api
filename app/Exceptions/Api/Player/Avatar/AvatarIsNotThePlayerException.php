<?php

namespace App\Exceptions\Api\Player\Avatar;

use App\Exceptions\Api\CustomException;

class AvatarIsNotThePlayerException extends CustomException
{
    protected $code = 422;

    protected string $key = __CLASS__;
}
