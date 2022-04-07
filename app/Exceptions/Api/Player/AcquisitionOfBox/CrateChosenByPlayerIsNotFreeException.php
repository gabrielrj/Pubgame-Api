<?php

namespace App\Exceptions\Api\Player\AcquisitionOfBox;

use Exception;

class CrateChosenByPlayerIsNotFreeException extends Exception
{
    protected $code = 422;

    protected $message = 'The box chosen by the player is not free.';
}
