<?php

namespace App\Http\Requests\Api\Game;

use App\Exceptions\Api\Player\AuthAndAccess\PlayerEmailAndPasswordException;
use App\Http\Controllers\Api\ApiResponseExceptionController;
use App\Http\Controllers\Api\Apps\Traits\AppControllerCallableIntercept;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use JetBrains\PhpStorm\ArrayShape;

class RegisterPlayerRequest extends FormRequest
{
    use RequestFailedConversionJson;

    protected string $actionName = 'validate user register';

    protected int $errorCode = 422;

    protected int $statusCode = 422;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['nickname' => "string[]", 'email' => "array", 'password' => "array"])]
    public function rules(): array
    {
        return [
            'nickname' => ['required', 'max:255'],

            'email' => ['required', 'email', 'max:255', Rule::unique('players')],

            'password' => [
                'required',
                'confirmed',
                Password::default()
            ]
        ];
    }


}
