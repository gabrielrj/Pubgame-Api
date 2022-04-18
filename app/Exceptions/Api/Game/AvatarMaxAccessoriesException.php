<?php

namespace App\Exceptions\Api\Game;

use Exception;

class AvatarMaxAccessoriesException extends Exception
{
    protected $code = 422;

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message ?? __('exceptions.AvatarMaxAccessoriesException');
    }
}
