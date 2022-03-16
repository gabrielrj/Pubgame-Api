<?php

namespace App\Services\Repositories\Traits;

use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;

trait HasQueryByUuid
{
    /**
     * @throws BindingResolutionException|Exception
     */
    function findByUuid(string $uuid, array $relationships = []): ?Model{
        return $this->run(function () use($uuid, $relationships){
            return $this->newQuery()
                ->with($relationships)
                ->whereUuid($uuid)
                ->first();
        }, __FUNCTION__);
    }
}
