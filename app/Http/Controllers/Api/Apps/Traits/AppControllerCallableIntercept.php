<?php

namespace App\Http\Controllers\Api\Apps\Traits;

use App\Exceptions\Api\Player\AuthAndAccess\UnauthorizedPlayerAccessException;
use App\Models\Game\Player;
use function auth;
use function response;

trait AppControllerCallableIntercept
{
    protected string $actionName;

    public function run(callable $fn): \Illuminate\Http\JsonResponse
    {
        try {
            if(auth()->user() && !(auth()->user() instanceof Player))
                throw new UnauthorizedPlayerAccessException();

            $response = $fn();

            return response()->json([
                'success' => true,
                'jsonData' => $response
            ]);
        }catch (\Exception $exception){
            $httpCode = $exception->getCode() != 0 ? $exception->getCode() : 500;

            $errors = [
                'success' => false,
                'error' =>
                    [
                        'action_name' => $this->actionName,
                        //'exception_type' => gettype($exception),
                        'exception_message' => $exception->getMessage(),
                        //'exception_trace' => $exception->getTraceAsString(),
                        'exception_code' => $httpCode
                    ]
            ];

            return response()->json($errors, $httpCode)->withHeaders($errors);
        }
    }
}
