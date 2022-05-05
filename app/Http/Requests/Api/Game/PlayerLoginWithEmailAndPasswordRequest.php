<?php

namespace App\Http\Requests\Api\Game;

use Illuminate\Foundation\Http\FormRequest;

class PlayerLoginWithEmailAndPasswordRequest extends FormRequest
{
    use RequestFailedConversionJson;

    protected string $actionName = "player login with email and password";

    protected int $errorCode = 422;

    protected int $statusCode = 422;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }
}
