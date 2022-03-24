<?php

namespace App\Exceptions\Api\Player\Avatar;

use Exception;

class AvatarIsNotThePlayerException extends Exception
{
    protected $code = 422;

    protected $message = 'The selected avatar does not belong to the logged in player.';
}
