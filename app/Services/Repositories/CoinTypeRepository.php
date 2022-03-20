<?php

namespace App\Services\Repositories;

use App\Models\Game\Settings\CoinType;

class CoinTypeRepository extends BaseRepository implements CoinTypeRepositoryInterface
{
    protected string $modelClass = CoinType::class;
}
