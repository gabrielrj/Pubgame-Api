<?php

namespace App\Services\Repositories;

use App\Models\Game\Settings\BoxAccessoryType;

class BoxAccessoryTypeRepository extends BaseRepository implements BoxAccessoryTypeRepositoryInterface
{
    protected string $modelClass = BoxAccessoryType::class;
}
