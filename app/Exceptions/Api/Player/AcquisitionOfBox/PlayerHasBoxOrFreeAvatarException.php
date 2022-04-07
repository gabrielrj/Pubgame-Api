<?php

namespace App\Exceptions\Api\Player\AcquisitionOfBox;

use Exception;

class PlayerHasBoxOrFreeAvatarException extends Exception
{
    protected $message = 'Player already has a box or a free avatar and therefore cannot purchase another one.';

    protected $code = 422;
}
