<?php

namespace App\Services\Repositories;

use App\Models\User;
use App\Services\Repositories\Traits\HasQueryByUuid;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    use HasQueryByUuid;

    protected string $modelClass = User::class;
}
