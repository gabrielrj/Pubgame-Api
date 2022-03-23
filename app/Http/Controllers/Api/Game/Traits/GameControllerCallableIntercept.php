<?php

namespace App\Http\Controllers\Api\Game\Traits;

use App\Exceptions\Api\Player\AuthAndAccess\UnauthorizedPlayerAccessException;
use App\Http\Controllers\Api\ApiResponseException;
use App\Models\Game\Player;

trait GameControllerCallableIntercept
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
            $errors = (new ApiResponseException())($exception, $this->actionName);

            return response()->json($errors)->withHeaders($errors);
        }
    }
}
