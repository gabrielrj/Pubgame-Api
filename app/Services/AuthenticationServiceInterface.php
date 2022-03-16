<?php

namespace App\Services;

interface AuthenticationServiceInterface
{
    public function login(array $payload) : ?string;
}
