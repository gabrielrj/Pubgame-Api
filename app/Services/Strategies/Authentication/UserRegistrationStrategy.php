<?php

namespace App\Services\Strategies\Authentication;

use App\Models\Game\Player;
use App\Services\Traits\ServiceCallableIntercept;
use App\Services\UserRegistrationServiceInterface;
use Exception;

class UserRegistrationStrategy implements \App\Services\UserRegistrationServiceInterface
{
    protected UserRegistrationServiceInterface $sender;

    public function __construct(UserRegistrationServiceInterface $registrationService)
    {
        $this->sender = $registrationService;
    }

    /**
     * @throws Exception
     */
    function register(array $payload): Player
    {
        return $this->sender->register($payload);
    }

    /**
     * @throws Exception
     */
    function registerAndLogin(array $payload): ?string
    {
        return $this->sender->registerAndLogin($payload);
    }
}
