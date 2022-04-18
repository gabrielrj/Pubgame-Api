<?php

namespace App\Http\Requests\Api\Game;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class BeerPoingGameRequest extends FormRequest
{
    use RequestFailedConversionJson;

    protected string $actionName = "";

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
    #[ArrayShape(['avTiD' => "array", 'pubTiD' => "array"])]
    public function rules(): array
    {
        return [
            'avTiD' => ['required', 'exists:avatars,uuid'],
            'pubTiD' => ['required', 'exists:pub_tables,id'],
        ];
    }
}
