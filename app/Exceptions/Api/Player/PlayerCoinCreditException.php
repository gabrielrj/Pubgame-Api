<?php

namespace App\Exceptions\Api\Player;

use App\Exceptions\Api\CustomException;

class PlayerCoinCreditException extends CustomException
{
    protected string $key = PlayerCoinCreditException::class;

    protected $code = 500;
}
