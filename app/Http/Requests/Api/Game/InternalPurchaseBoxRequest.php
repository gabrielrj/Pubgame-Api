<?php

namespace App\Http\Requests\Api\Game;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class InternalPurchaseBoxRequest extends FormRequest
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
    #[ArrayShape(['bid' => "string[]"])]
    public function rules(): array
    {
        return [
            'bid' => ['required', 'exists:box_accessory_types,id']
        ];
    }
}
