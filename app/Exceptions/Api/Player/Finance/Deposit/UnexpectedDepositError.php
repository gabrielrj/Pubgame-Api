<?php

namespace App\Exceptions\Api\Player\Finance\Deposit;

use App\Exceptions\Api\CustomException;
use Exception;

class UnexpectedDepositError extends CustomException
{
    protected string $key = __CLASS__;

    protected $message = 'An Unexpected error occurred while trying to make the deposit.';
}
