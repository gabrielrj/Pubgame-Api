<?php

namespace App\Services\Traits;

use App\Services\ErrorTrappingServiceInterface;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\App;

trait ServiceCallableIntercept
{
    protected string $file;

    protected ?Authenticatable $userLogged = null;

    public function __construct()
    {
        if(auth('player')->check())
            $this->userLogged = auth('player')->user();
        elseif(auth()->check())
            $this->userLogged = auth()->user();
    }

    /**
     * @throws Exception
     */
    function run(callable $fn, string $fnName){
        try {
            $this->file = self::class;

            return $fn();
        }catch (Exception $exception){
            $errorLogTrappingService = App::make(ErrorTrappingServiceInterface::class);

            $errorLogTrappingService->logNewErrorException($this->file, $fnName, get_class($exception), $exception->getMessage(), $exception->getTraceAsString(), $this->userLogged);

            throw $exception;
        }
    }
}
