<?php

namespace App\Http\Controllers\Api\Apps\Dashboard\Auth;

use App\Http\Controllers\Api\ApiResponseExceptionController;
use App\Http\Controllers\Api\Apps\Traits\AppControllerCallableIntercept;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Dashboard\UserSignInRequest;
use App\Services\DashboardServices\UserAuthenticationInterface;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    use AppControllerCallableIntercept;

    protected UserAuthenticationInterface $userAuthentication;

    public function __construct(UserAuthenticationInterface $userAuthentication)
    {
        $this->userAuthentication = $userAuthentication;
    }

    public function login(UserSignInRequest $request)
    {
        try {
            $this->userAuthentication->login($request->only('email', 'password'));
        }catch (\Exception $exception){
            $errors = (new ApiResponseExceptionController())($exception, 'dashboard user login');

            return response()->json($errors, $errors['http_code'])->withHeaders($errors);
        }

    }
}
