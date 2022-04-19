<?php

namespace App\Services\Traits;

use App\Exceptions\Api\CustomException;
use App\Exceptions\Api\UnexpectedErrorException;
use App\Services\ErrorTrappingServiceInterface;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\App;

trait ServiceCallableIntercept
{
    protected string $file;

    protected ?Authenticatable $userLogged = null;

    /**
     * @throws Exception
     */
    function run(callable $fn, string $fnName){
        try {
            if(auth('player')->check())
                $this->userLogged = auth('player')->user();
            elseif(auth()->check())
                $this->userLogged = auth()->user();

            $this->file = self::class;

            return $fn();
        }catch (Exception $exception){
            $errorLogTrappingService = App::make(ErrorTrappingServiceInterface::class);

            $errorLogTrappingService->logNewErrorException($this->file, $fnName, get_class($exception), $exception->getMessage(), $exception->getTraceAsString(), $this->userLogged);

            /*if(!($exception instanceof CustomException))
                throw new UnexpectedErrorException();*/

            throw $exception;
        }
    }
}
