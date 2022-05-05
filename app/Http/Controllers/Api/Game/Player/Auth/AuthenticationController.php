<?php

namespace App\Http\Controllers\Api\Game\Player\Auth;

use App\Exceptions\Api\FeatureNotImplementedException;
use App\Exceptions\Api\Player\AuthAndAccess\UnauthorizedPlayerLoginException;
use App\Http\Controllers\Api\Game\Traits\GameControllerCallableIntercept;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Game\PlayerLoginWithEmailAndPasswordRequest;
use App\Services\Repositories\PlayerRepositoryInterface;
use App\Services\Strategies\Authentication\AuthenticationStrategy;
use App\Services\Strategies\Authentication\PlayerAuthenticationWithEmailAndPasswordStrategy;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AuthenticationController extends Controller
{
    use GameControllerCallableIntercept;

    protected PlayerRepositoryInterface $playerRepository;

    public function __construct(PlayerRepositoryInterface $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function loginWithWalletAddress(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->actionName = 'login with wallet address';

        return $this->run(function () use($request){
            throw new FeatureNotImplementedException();
        });
    }

    public function loginWithEmailAndPassword(PlayerLoginWithEmailAndPasswordRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->actionName = 'login with email and password';

        return $this->run(function () use($request){
            $payload = $request->only('email', 'password');

            $authService = new AuthenticationStrategy(new PlayerAuthenticationWithEmailAndPasswordStrategy());

            $accessToken = $authService->login($payload);

            if(!$accessToken)
                throw new UnauthorizedPlayerLoginException();

            $player = $this->playerRepository->findById(auth('player')->id());

            return [
                'accessToken' => $accessToken,
                'player' => $player,
            ];

        });
    }
}
