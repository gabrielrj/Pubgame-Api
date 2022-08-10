<?php

namespace App\Exceptions\Api\Avatar;

use Exception;

class AccessoryDoesNotBelongToThePlayerException extends Exception
{
    protected $code = 422;

    protected string $key = __CLASS__;

    protected $message = 'This accessory does not belong to the player.';
}
