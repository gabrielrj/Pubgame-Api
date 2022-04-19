<?php

namespace App\Exceptions\Api\Player\AcquisitionOfBox;

use App\Exceptions\Api\CustomException;

class InvalidBoxException extends CustomException
{
    protected string $key = InvalidBoxException::class;
}
