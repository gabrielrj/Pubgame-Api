<?php

namespace App\Exceptions\Api\Avatar;

use App\Exceptions\Api\CustomException;

class AccessoryIsAlreadyMountedOnAnotherAvatarException extends CustomException
{
    protected $code = 422;

    protected string $key = __CLASS__;

    protected $message = 'This accessory is already mounted on another avatar.';
}
