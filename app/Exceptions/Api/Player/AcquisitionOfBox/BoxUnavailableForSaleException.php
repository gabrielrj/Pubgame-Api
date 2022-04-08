<?php

namespace App\Exceptions\Api\Player\AcquisitionOfBox;

use Exception;

class BoxUnavailableForSaleException extends Exception
{
    protected $code = 422;

    protected $message = "This box is currently unavailable for sale.";
}
