<?php

namespace App\Exceptions\Api;

class FeatureNotImplementedException extends CustomException
{
    protected string $key = __CLASS__;

    protected $code = 501;
}
