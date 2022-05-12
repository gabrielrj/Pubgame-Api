<?php

namespace App\Http\Controllers\Api\Apps\Traits;

use App\Exceptions\Api\Player\AuthAndAccess\UnauthorizedPlayerAccessException;
use App\Exceptions\Api\User\AuthAndAccess\UnauthorizedUserAccessException;
use App\Http\Controllers\Api\ApiResponseExceptionController;
use App\Models\Game\Player;
use App\Models\User;
use function auth;
use function response;

trait AppControllerCallableIntercept
{
    protected string $actionName;

    public function run(callable $fn): \Illuminate\Http\JsonResponse
    {
        try {
            if(auth()->user() && !(auth()->user() instanceof User))
                throw new UnauthorizedUserAccessException();

            $response = $fn();

            return response()->json($response);
        }catch (\Exception $exception){
            $errors = (new ApiResponseExceptionController())($exception, $this->actionName);

            return response()->json($errors, $errors['http_code'])->withHeaders($errors);
        }
    }
}
