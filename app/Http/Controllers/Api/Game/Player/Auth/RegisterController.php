<?php

namespace App\Http\Controllers\Api\Game\Player\Auth;

use App\Exceptions\Api\Player\AuthAndAccess\UnauthorizedPlayerLoginException;
use App\Http\Controllers\Api\Apps\Traits\AppControllerCallableIntercept;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Game\RegisterUserRequest;
use App\Services\Repositories\PlayerRepositoryInterface;
use App\Services\Strategies\Authentication\PlayerRegistrationWithEmailAndPasswordStrategy;
use App\Services\Strategies\Authentication\UserRegistrationStrategy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    use AppControllerCallableIntercept;

    protected PlayerRepositoryInterface $playerRepository;

    public function __construct(PlayerRepositoryInterface $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function signUp(RegisterUserRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->actionName = 'only sign up';

        return $this->run(function () use($request){
            $payload = $request->all();

            $userRegisterService = new UserRegistrationStrategy(new PlayerRegistrationWithEmailAndPasswordStrategy());

            return [
                'userHasBeenRegistered' => $userRegisterService->register($payload)
            ];
        });
    }

    public function signUpAndSignIn(RegisterUserRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->actionName = 'sign up and perform login';

        return $this->run(function () use($request){
            $payload = $request->only('email', 'password');

            $userRegisterService = new UserRegistrationStrategy(new PlayerRegistrationWithEmailAndPasswordStrategy());

            $accessToken = $userRegisterService->registerAndLogin($payload);

            if(!$accessToken)
                throw new UnauthorizedPlayerLoginException();

            $player = $this->playerRepository->findById(auth('player')->id());

            return [
                'accessToken' => $accessToken,
                'player' => $player
            ];
        });
    }
}
