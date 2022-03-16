<?php

namespace App\Services\Strategies\Authentication;

use App\Exceptions\Api\FeatureNotImplementedException;
use App\Services\AuthenticationServiceInterface;
use App\Services\Traits\ServiceCallableIntercept;
use Exception;

class UserAuthenticationStrategy implements AuthenticationServiceInterface
{
    use ServiceCallableIntercept;

    /**
     * @throws Exception
     */
    public function login(array $payload) : ?string
    {
        return $this->run(function () use ($payload){
            throw new FeatureNotImplementedException();
        }, __FUNCTION__);
    }
}
