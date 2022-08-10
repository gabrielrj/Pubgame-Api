<?php

namespace App\Exceptions\Api\Avatar;

use Exception;

class AccessoryLimitForMountingExceededException extends Exception
{
    protected $code = 422;

    protected string $key = __CLASS__;

    protected $message = 'It is only allowed to assemble up to 6 (six) accessories per avatar.';
}
