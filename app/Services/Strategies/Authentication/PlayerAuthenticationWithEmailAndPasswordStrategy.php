<?php

namespace App\Services\Strategies\Authentication;

use App\Exceptions\Api\Player\AuthAndAccess\UnauthorizedPlayerLoginException;
use App\Services\AuthenticationServiceInterface;
use App\Services\Repositories\PlayerRepository;
use App\Services\Repositories\PlayerRepositoryInterface;
use App\Services\Traits\ServiceCallableIntercept;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class PlayerAuthenticationWithEmailAndPasswordStrategy implements AuthenticationServiceInterface
{
    use ServiceCallableIntercept;

    protected PlayerRepositoryInterface $playerRepository;

    /**
     */
    public function __construct()
    {
        $this->playerRepository = App::make(PlayerRepositoryInterface::class);
    }

    /**
     * @throws Exception
     */
    public function login(array $payload) : ?string
    {
        return $this->run(function () use ($payload){
            $guard = 'player';

            $player = $this->playerRepository->newQuery()->where('email', '=', $payload['email'])->first();

            throw_if(!$player, new UnauthorizedPlayerLoginException('Login not authorized because no player with that registered email was found.'));

            throw_unless(Hash::check($payload['password'], $player->password), new UnauthorizedPlayerLoginException('The provided credentials are incorrect.'));

            throw_if($player->is_blocked, new UnauthorizedPlayerLoginException('Player is blocked!'));

            auth($guard)->login($player);

            auth($guard)->user()->tokens()->delete();

            $token = \auth($guard)->user()->createToken($guard . '_auth_token');

            return $token->plainTextToken;
        }, __FUNCTION__);
    }
}
