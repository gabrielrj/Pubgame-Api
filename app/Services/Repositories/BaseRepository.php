<?php

namespace App\Services\Repositories;

use App\Services\Traits\ServiceCallableIntercept;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements RepositoryInterface
{
    use ServiceCallableIntercept;

    protected string $modelClass;

    /**
     * @throws BindingResolutionException
     * @throws Exception
     */
    function newQuery(): Builder
    {
        return $this->run(function (){
            return app()->make($this->modelClass)->newQuery();
        }, __FUNCTION__);
    }

    /**
     * @throws Exception
     */
    function findById(int $id, array $relationships = []): ?Model
    {
        return $this->run(function () use($id, $relationships){
            return $this->newQuery()
                ->with($relationships)
                ->find($id);
        }, __FUNCTION__);
    }

    /**
     * @throws Exception
     */
    function getAll(array $relationships = []): Collection
    {
        return $this->run(function () use($relationships){
            return $this->newQuery()
                ->with($relationships)
                ->get();
        }, __FUNCTION__);
    }

    /**
     * @throws Exception
     */
    function save(Model $model): bool
    {
        return $this->run(function () use($model){
            return $model->save();
        }, __FUNCTION__);
    }

    /**
     * @throws Exception
     */
    function create(array $payload): Model
    {
        return $this->run(function () use($payload){
            return $this->newQuery()->create($payload);
        }, __FUNCTION__);
    }

    /**
     * @throws Exception
     */
    function update(Model $model, array $payload): bool
    {
        return $this->run(function () use($model, $payload){
            return $model->update($payload);
        }, __FUNCTION__);
    }

    /**
     * @throws Exception
     */
    function delete(Model $model): bool
    {
        return $this->run(function () use($model){
            return $model->delete();
        }, __FUNCTION__);
    }

    /**
     * @throws Exception
     */
    function forceDelete(Model $model): ?bool
    {
        return $this->run(function () use($model){
            return $model->forceDelete();
        }, __FUNCTION__);
    }

    /**
     * @throws Exception
     */
    function createAndGetData(array $payload, array $relationships = []) : ?Model
    {
        return $this->run(function () use ($payload, $relationships) {
            $newModel = $this->create($payload);

            return $this->findById($newModel->id, $relationships);
        }, __FUNCTION__);
    }

    function findByUuid(string $uuid, array $relationships = []): ?Model
    {
        // TODO: Implement findByUuid() method.
    }
}
