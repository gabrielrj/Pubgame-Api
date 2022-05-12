<?php

namespace App\Http\Controllers\Api\Apps\Dashboard\Auth;

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

    public function login(UserSignInRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->actionName = 'dashboard user login';

        return $this->run(function () use($request){
            return $this->userAuthentication->login($request->only('email', 'password'));
        });

    }

    public function getUserLogged(): \Illuminate\Http\JsonResponse
    {
        $this->actionName = 'get dashboard user data';

        return $this->run(function () {
            return auth()->user();
        });
    }
}
