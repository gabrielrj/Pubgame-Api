<?php

namespace App\Exceptions\Api\Avatar;

use App\Exceptions\Api\CustomException;

class AccessoryLimitForMountingExceededException extends CustomException
{
    protected $code = 422;

    protected string $key = __CLASS__;

    protected $message = 'It is only allowed to assemble up to 6 (six) accessories per avatar.';
}
