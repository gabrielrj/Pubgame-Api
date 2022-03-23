<?php

namespace App\Exceptions\Api;

use Exception;

class FeatureNotImplementedException extends Exception
{
    protected $message = 'This feature has not yet been implemented.';

    protected $code = 501;
}
