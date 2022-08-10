<?php

namespace App\Exceptions\Api\Avatar;

use Exception;

class AccessoryIsAlreadyMountedOnAnotherAvatarException extends Exception
{
    protected $code = 422;

    protected string $key = __CLASS__;

    protected $message = 'This accessory is already mounted on another avatar.';
}
