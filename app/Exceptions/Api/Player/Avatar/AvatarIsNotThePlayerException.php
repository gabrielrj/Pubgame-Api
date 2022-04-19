<?php

namespace App\Exceptions\Api\Player\Avatar;

use App\Exceptions\Api\CustomException;

class AvatarIsNotThePlayerException extends CustomException
{
    protected string $key = __CLASS__;
}
