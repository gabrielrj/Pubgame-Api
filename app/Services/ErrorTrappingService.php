<?php

namespace App\Services;

use App\Services\Repositories\ErrorLogRepositoryInterface;
use Illuminate\Contracts\Auth\Authenticatable;

class ErrorTrappingService implements ErrorTrappingServiceInterface
{
    protected ErrorLogRepositoryInterface $errorLogRepository;

    public function __construct(ErrorLogRepositoryInterface $errorLogRepository)
    {
        $this->errorLogRepository = $errorLogRepository;
    }

    function logNewErrorException(string $file,
                                  string $function,
                                  string $exception,
                                  string $message,
                                  string $stack,
                                  ?Authenticatable $user = null): bool
    {
        try {
            $newError = $this->errorLogRepository->create([
                'file' => $file,
                'function' => $function,
                'exception' => $exception,
                'message' => $message,
                'stack' => $stack
            ]);

            if($user)
                $user->errors()->save($newError);

            return true;
        }catch (\Exception $exception){
            return false;
        }
    }
}
