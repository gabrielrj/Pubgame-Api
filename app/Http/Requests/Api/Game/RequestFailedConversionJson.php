<?php

namespace App\Http\Requests\Api\Game;

use App\Http\Controllers\Api\ApiResponseExceptionController;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait RequestFailedConversionJson
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json((new ApiResponseExceptionController())($validator->errors(), $this->actionName, $this->errorCode), $this->statusCode));
    }
}
