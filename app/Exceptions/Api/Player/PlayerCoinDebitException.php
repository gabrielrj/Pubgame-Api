<?php

namespace App\Exceptions\Api\Player;

use App\Exceptions\Api\CustomException;

class PlayerCoinDebitException extends CustomException
{
    protected string $key = __CLASS__;

    protected $code = 500;
}
