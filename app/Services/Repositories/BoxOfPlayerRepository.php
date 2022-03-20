<?php

namespace App\Services\Repositories;

use App\Models\Game\BoxOfPlayer;
use App\Services\Repositories\Traits\HasQueryByUuid;

class BoxOfPlayerRepository extends BaseRepository implements BoxOfPlayerRepositoryInterface
{
    use HasQueryByUuid;

    protected string $modelClass = BoxOfPlayer::class;
}
