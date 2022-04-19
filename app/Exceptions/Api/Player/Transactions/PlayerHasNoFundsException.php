<?php

namespace App\Exceptions\Api\Player\Transactions;

use App\Exceptions\Api\CustomException;

class PlayerHasNoFundsException extends CustomException
{
    protected string $key = __CLASS__;
}
