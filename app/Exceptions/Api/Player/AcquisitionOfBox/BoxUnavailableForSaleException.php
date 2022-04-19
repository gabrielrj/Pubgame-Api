<?php

namespace App\Exceptions\Api\Player\AcquisitionOfBox;

use App\Exceptions\Api\CustomException;

class BoxUnavailableForSaleException extends CustomException
{
    protected string $key = BoxUnavailableForSaleException::class;
}
