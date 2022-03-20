<?php

namespace App\Services\Repositories;

use App\Models\Game\Settings\PubTable;

class PubTableRepository extends BaseRepository implements PubTableRepositoryInterface
{
    protected string $modelClass = PubTable::class;
}
