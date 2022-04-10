<?php

namespace App\Http\Controllers\Api;


use Illuminate\Support\MessageBag;
use JetBrains\PhpStorm\ArrayShape;

class ApiResponseExceptionController
{

    #[ArrayShape(['success' => "false", 'action_name' => "string", 'validation_errors' => "mixed", 'error' => "mixed", 'http_code' => "mixed"])]
    public function __invoke(\Exception|MessageBag $exception, string $actionName, int $errorCode = 0): array
    {
        $exceptionMessages = [];
        $exceptionMessage = null;

        if($exception instanceof \Exception){
            $errorCode = ($errorCode == 0 && $exception->getCode() != 0) ? $exception->getCode() : 500;
            $exceptionMessage = $exception->getMessage();
        }else
            $exceptionMessages = $exception->all();

        return [
            'success' => false,
            'action_name' => $actionName,
            'validation_errors' => $exceptionMessages,
            'error' => $exceptionMessage,
            'http_code' => $errorCode
        ];
    }
}
