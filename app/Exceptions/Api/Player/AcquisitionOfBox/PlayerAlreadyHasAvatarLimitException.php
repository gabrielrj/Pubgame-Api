<?php

namespace App\Exceptions\Api\Player\AcquisitionOfBox;

use Exception;

class PlayerAlreadyHasAvatarLimitException extends Exception
{
    protected $code = 422;

    protected $message = "The player has already reached the maximum avatar limit.";
}
