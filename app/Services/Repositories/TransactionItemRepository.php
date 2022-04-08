<?php

namespace App\Services\Repositories;

use App\Models\Game\TransactionItem;

class TransactionItemRepository extends BaseRepository implements TransactionItemRepositoryInterface
{
    protected string $modelClass = TransactionItem::class;
}
