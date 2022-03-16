<?php

namespace App\Services\Repositories;


use Illuminate\Database\Eloquent\Model;

interface PlayerRepositoryInterface extends RepositoryInterface
{
    function findByUuid(string $uuid, array $relationships = []): ?Model;
}
