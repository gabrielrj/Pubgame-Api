<?php

namespace App\Exceptions\Api\Avatar;

use App\Exceptions\Api\CustomException;

class AccessoryDoesNotBelongToThePlayerException extends CustomException
{
    protected $code = 422;

    protected string $key = __CLASS__;

    protected $message = 'This accessory does not belong to the player.';
}
