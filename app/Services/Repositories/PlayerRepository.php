<?php

namespace App\Services\Repositories;

use App\Models\Game\Player;
use App\Services\Repositories\Traits\HasQueryByUuid;
use Illuminate\Database\Eloquent\Model;

class PlayerRepository extends BaseRepository implements PlayerRepositoryInterface
{
    use HasQueryByUuid;

    protected string $modelClass = Player::class;
}
