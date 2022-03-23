<?php

namespace App\Exceptions\Api\Player\Transactions;

use Exception;

class PlayerHasNoFundsException extends Exception
{
    protected $code = 422;

    protected $message = 'Player does not have sufficient funds in the chosen currency to carry out this transaction.';
}
