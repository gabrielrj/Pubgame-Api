<?php

namespace App\Exceptions\Api\Player\AuthAndAccess;

use Exception;

class PlayerEmailAlreadyRegisteredException extends Exception
{
    protected $message = 'There is already a player with that email in the database.';
}
