<?php

namespace App\Exceptions\Api\Player\Finance\Withdrawal;

use App\Exceptions\Api\CustomException;
use Exception;

class InsufficientFundsForWithdrawalException extends CustomException
{
    protected string $key = __CLASS__;

    protected $message = 'The player does not have sufficient funds to withdraw.';
}
