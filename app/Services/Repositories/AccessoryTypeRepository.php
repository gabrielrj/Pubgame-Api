<?php

namespace App\Services\Repositories;

use App\Models\Game\Settings\AccessoryType;

class AccessoryTypeRepository extends BaseRepository implements AccessoryTypeRepositoryInterface
{
    protected string $modelClass = AccessoryType::class;
}
