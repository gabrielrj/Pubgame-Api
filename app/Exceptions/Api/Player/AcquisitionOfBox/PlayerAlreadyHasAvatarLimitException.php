<?php

namespace App\Exceptions\Api\Player\AcquisitionOfBox;

use App\Exceptions\Api\CustomException;

class PlayerAlreadyHasAvatarLimitException extends CustomException
{
    protected string $key = __CLASS__;
}
