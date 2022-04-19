<?php

namespace App\Exceptions\Api\Player\AcquisitionOfBox;

use App\Exceptions\Api\CustomException;

class CrateChosenByPlayerIsNotFreeException extends CustomException
{
    protected string $key = CrateChosenByPlayerIsNotFreeException::class;
}
