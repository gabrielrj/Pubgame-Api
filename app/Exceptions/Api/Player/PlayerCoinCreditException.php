<?php

namespace App\Exceptions\Api\Player;

use Exception;

class PlayerCoinCreditException extends Exception
{
    protected $code = 500;

    protected $message = 'An unexpected error occurred when trying to credit the selected coins to the player.';
}
