<?php

namespace App\Services\Strategies\Authentication;

use App\Services\AuthenticationServiceInterface;
use App\Services\Traits\ServiceCallableIntercept;
use Exception;

class AuthenticationStrategy implements AuthenticationServiceInterface
{
    protected AuthenticationServiceInterface $sender;

    public function __construct(AuthenticationServiceInterface $authenticationService)
    {
        $this->sender = $authenticationService;
    }

    /**
     * @throws Exception
     */
    public function login(array $payload) : ?string
    {
        return $this->sender->login($payload);
    }
}
