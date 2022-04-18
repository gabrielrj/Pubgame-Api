<?php

namespace App\Services\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    function newQuery() : Builder;

    function findByUuid(string $uuid, array $relationships = []) : ?Model;

    function findById(int $id, array $relationships = []) : ?Model;

    function getAll(array $relationships = []) : Collection;

    function save(Model $model): bool;

    function create(array $payload): Model;

    function update(Model $model, array $payload): bool;

    function delete(Model $model): bool;

    function forceDelete(Model $model): ?bool;

    function createAndGetData(array $payload, array $relationships = []) : ?Model;
}
