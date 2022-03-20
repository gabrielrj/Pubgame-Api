<?php

namespace App\Services\Repositories;

use App\Models\Game\Settings\BoxAccessoryRarityType;

class BoxAccessoryRarityTypeRepository extends BaseRepository implements BoxAccessoryRarityTypeRepositoryInterface
{
    protected string $modelClass = BoxAccessoryRarityType::class;
}
