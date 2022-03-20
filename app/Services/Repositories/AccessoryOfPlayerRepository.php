<?php

namespace App\Services\Repositories;

use App\Models\Game\AccessoryOfPlayer;
use App\Services\Repositories\Traits\HasQueryByUuid;

class AccessoryOfPlayerRepository extends BaseRepository implements AccessoryOfPlayerRepositoryInterface
{
    use HasQueryByUuid;

    protected string $modelClass = AccessoryOfPlayer::class;
}
