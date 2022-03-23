<?php

namespace App\Exceptions\Api\Player;

use Exception;

class PlayerCoinDebitException extends Exception
{
    protected $code = 500;

    protected $message = 'An unexpected error occurred when trying to debit the coins selected by the player.';
}
