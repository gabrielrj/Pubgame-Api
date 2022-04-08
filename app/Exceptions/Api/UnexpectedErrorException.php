<?php

namespace App\Exceptions\Api;

use Exception;

class UnexpectedErrorException extends Exception
{
    protected $code = 500;

    protected $message = "An unexpected error occurred while trying to perform the operation.";
}
