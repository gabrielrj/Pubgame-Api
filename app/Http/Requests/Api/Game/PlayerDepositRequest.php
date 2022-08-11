<?php

namespace App\Http\Requests\Api\Game;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class PlayerDepositRequest extends FormRequest
{
    use RequestFailedConversionJson;

    protected string $actionName = "Player register registers deposit";

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
    #[ArrayShape(['busdDepositAmount' => "string[]"])]
    public function rules(): array
    {
        return [
            'busdDepositAmount' => [
                'min:50',
                'required',
                'numeric',
                Rule::in([50, 100, 150, 200, 250])
            ]
        ];
    }
}
