<?php

namespace App\Services\Repositories;

use Illuminate\Database\Eloquent\Model;

interface TransactionRepositoryInterface extends RepositoryInterface
{
    public function create(array $payload, Model $item = null): Model;
}
