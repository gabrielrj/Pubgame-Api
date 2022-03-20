<?php

namespace App\Services\Repositories;

use App\Models\Game\Settings\GameType;

class GameTypeRepository extends BaseRepository implements GameTypeRepositoryInterface
{
    protected string $modelClass = GameType::class;
}
