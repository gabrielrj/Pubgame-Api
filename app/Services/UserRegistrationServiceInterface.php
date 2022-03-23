<?php

namespace App\Services;

use App\Models\Game\Player;

interface UserRegistrationServiceInterface
{
    function register(array $payload): Player;

    function registerAndLogin(array $payload): ?string;
}
