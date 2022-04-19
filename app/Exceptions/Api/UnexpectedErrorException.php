<?php

namespace App\Exceptions\Api;

class UnexpectedErrorException extends CustomException
{
    protected string $key = __CLASS__;

    protected $code = 500;
}
