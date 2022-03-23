<?php

namespace App\Services\Repositories;

use App\Models\Game\Game;
use App\Services\Repositories\Traits\HasQueryByUuid;

class GameRepository extends BaseRepository implements GameRespositoryInterface
{
    use HasQueryByUuid;

    protected string $modelClass = Game::class;
}
