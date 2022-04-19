<?php

namespace App\Exceptions\Api\Player\AcquisitionOfBox;

use App\Exceptions\Api\CustomException;

class PlayerHasBoxOrFreeAvatarException extends CustomException
{
    protected string $key = PlayerHasBoxOrFreeAvatarException::class;
}
