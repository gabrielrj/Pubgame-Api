<?php

namespace App\Services\DashboardServices;

use App\Services\Repositories\UserRepositoryInterface;
use App\Services\Traits\ServiceCallableIntercept;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;

class UserAuthentication implements UserAuthenticationInterface
{
    use ServiceCallableIntercept;

    protected UserRepositoryInterface $userRepository;

    /**
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws Exception
     */
    public function login(array $payload): ?string
    {
        return $this->run(function () use($payload){
            $user = $this->userRepository->newQuery()->where('email', '=', $payload['email'])->first();

            throw_if(!$user, new Exception('User not found!'));

            if(!auth()->attempt(['email' => $payload['email'], 'password' => $payload['password']]))
                throw new AuthenticationException();

            return '';

            /*throw_unless(Hash::check($payload['password'], $user->password), new Exception('The provided credentials are incorrect.'));

            auth()->login($user);

            auth()->user()->tokens()->delete();

            $token = \auth()->user()->createToken('dashboard_auth_token');

            return $token->plainTextToken;*/
        }, __FUNCTION__);
    }
}
