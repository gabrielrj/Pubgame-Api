<?php

namespace App\Http\Controllers\Api\Apps\Traits;

use App\Exceptions\Api\Player\AuthAndAccess\UnauthorizedPlayerAccessException;
use App\Http\Controllers\Api\ApiResponseException;
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
                throw new UnauthorizedPlayerAccessException();

            $response = $fn();

            return response()->json([
                'success' => true,
                'json_data' => $response
            ]);
        }catch (\Exception $exception){
            $errors = (new ApiResponseException())($exception, $this->actionName);

            return response()->json($errors, $errors['http_code'])->withHeaders($errors);
        }
    }
}
