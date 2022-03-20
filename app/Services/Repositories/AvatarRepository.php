<?php

namespace App\Services\Repositories;

use App\Models\Game\Avatar;
use App\Services\Repositories\Traits\HasQueryByUuid;

class AvatarRepository extends BaseRepository implements AvatarRepositoryInterface
{
    use HasQueryByUuid;

    protected string $modelClass = Avatar::class;
}
