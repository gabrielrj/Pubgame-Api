<?php

namespace App\Exceptions\Api\Player\AuthAndAccess;

use Exception;

class PlayerEmailAndPasswordException extends Exception
{
    protected $code = 422;
}
