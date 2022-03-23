<?php

namespace App\Services\Strategies\Authentication;

use App\Exceptions\Api\Player\AuthAndAccess\PlayerEmailAlreadyRegisteredException;
use App\Models\Game\Player;
use App\Services\Repositories\PlayerRepositoryInterface;
use App\Services\Traits\ServiceCallableIntercept;
use Exception;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class PlayerRegistrationWithEmailAndPasswordStrategy implements \App\Services\UserRegistrationServiceInterface
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
     * @param array $payload | * email, * password;
     * @return Player
     * @throws Exception
     */
    function register(array $payload): Player
    {
        return $this->run(function () use ($payload) {
            if(!Arr::exists($payload, 'email') || !isset($payload['email']))
                throw new InvalidArgumentException('E-mail is required.');

            if(!Arr::exists($payload, 'password') || !isset($payload['password']))
                throw new InvalidArgumentException('Password is required.');

            $player = $this->playerRepository->newQuery()->where('email', '=', $payload['email'])->first();

            throw_if($player, PlayerEmailAlreadyRegisteredException::class);

            return $this->playerRepository->create(['email' => $payload['email'], 'password' => Hash::make($payload['password'])]);
        }, __FUNCTION__);
    }

    /**
     * @throws Exception
     */
    function registerAndLogin(array $payload): ?string
    {
        return $this->run(function () use ($payload) {
            $newPlayer = $this->register($payload);

            $authenticationService = new AuthenticationStrategy(new PlayerAuthenticationWithEmailAndPasswordStrategy());

            return $authenticationService->login(['email' => $newPlayer->email, 'password' => $newPlayer->password]);
        }, __FUNCTION__);
    }
}
