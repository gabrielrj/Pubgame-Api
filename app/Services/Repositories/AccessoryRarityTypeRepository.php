<?php

namespace App\Services\Repositories;

use App\Models\Game\Settings\AccessoryRarityType;

class AccessoryRarityTypeRepository extends BaseRepository implements AccessoryRarityTypeRepositoryInterface
{
    protected string $modelClass = AccessoryRarityType::class;
}
