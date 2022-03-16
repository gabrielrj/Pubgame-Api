<?php

namespace App\Services\Strategies\Authentication;

use App\Exceptions\Api\FeatureNotImplementedException;
use App\Services\AuthenticationServiceInterface;
use App\Services\Repositories\PlayerRepositoryInterface;
use App\Services\Traits\ServiceCallableIntercept;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

class PlayerAuthenticationWithWalletAddressStrategy implements AuthenticationServiceInterface
{
    use ServiceCallableIntercept;

    protected PlayerRepositoryInterface $playerRepository;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->playerRepository = app()->make(PlayerRepositoryInterface::class);
    }

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
