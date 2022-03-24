<?php

namespace App\Exceptions\Api\Game;

use Exception;

class AvatarMaxAccessoriesException extends Exception
{
    protected $code = 422;

    protected $message = 'The maximum number of accessories for this table has been reached.';
}
