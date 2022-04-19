<?php

namespace App\Exceptions\Api;

use Exception;
use Throwable;

abstract class CustomException extends Exception
{
    protected string $key;

    protected $code = 422;

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        $message = empty($message) ? __('exceptions.' . class_basename($this->key)) : $message;

        parent::__construct($message, $code, $previous);
    }
}
