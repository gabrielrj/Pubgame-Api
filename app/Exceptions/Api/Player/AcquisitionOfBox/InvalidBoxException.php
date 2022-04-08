<?php

namespace App\Exceptions\Api\Player\AcquisitionOfBox;

use Exception;

class InvalidBoxException extends Exception
{
    protected $code = 422;

    protected $message = "The box chosen by the player cannot be purchased by this means of acquisition, as it is a free box.";
}
