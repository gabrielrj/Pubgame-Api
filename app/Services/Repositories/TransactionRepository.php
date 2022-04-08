<?php

namespace App\Services\Repositories;

use App\Models\Game\Transaction;
use App\Services\Repositories\Traits\HasQueryByUuid;
use Illuminate\Database\Eloquent\Model;

class TransactionRepository extends BaseRepository implements TransactionRepositoryInterface
{
    use HasQueryByUuid;

    protected string $modelClass = Transaction::class;
}
