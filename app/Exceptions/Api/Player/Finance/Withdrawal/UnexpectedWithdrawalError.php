<?php

namespace App\Exceptions\Api\Player\Finance\Withdrawal;

use App\Exceptions\Api\CustomException;
use Exception;

class UnexpectedWithdrawalError extends CustomException
{
    protected string $key = __CLASS__;

    protected $message = 'An Unexpected error occurred while trying to make the withdrawal.';
}
