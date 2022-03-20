<?php

namespace App\Services\Repositories;

use App\Models\Game\Settings\Accessory;

class AccessoryRepository extends BaseRepository implements AccessoryRepositoryInterface
{
    protected string $modelClass = Accessory::class;
}
