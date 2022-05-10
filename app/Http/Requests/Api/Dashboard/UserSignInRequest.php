<?php

namespace App\Http\Requests\Api\Dashboard;

use App\Http\Requests\Api\Game\RequestFailedConversionJson;
use Illuminate\Foundation\Http\FormRequest;

class UserSignInRequest extends FormRequest
{
    use RequestFailedConversionJson;

    protected string $actionName = "dashboard user login";

    protected int $errorCode = 401;

    protected int $statusCode = 401;

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
            'password' => ['required']
        ];
    }
}
