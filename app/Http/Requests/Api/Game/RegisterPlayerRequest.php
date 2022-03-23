<?php

namespace App\Http\Requests\Api\Game;

use App\Exceptions\Api\Player\AuthAndAccess\PlayerEmailAndPasswordException;
use App\Http\Controllers\Api\ApiResponseException;
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

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json((new ApiResponseException())($validator->errors(), 'validate user register', 422), 422));
    }
}
