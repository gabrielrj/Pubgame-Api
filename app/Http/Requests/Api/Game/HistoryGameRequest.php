<?php

namespace App\Http\Requests\Api\Game;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class HistoryGameRequest extends FormRequest
{
    use RequestFailedConversionJson;

    protected string $actionName = 'get history games of player';

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
    #[ArrayShape(['dateGame' => "string[]"])]
    public function rules()
    {
        return [
            'dateGame' => ['required'],
        ];
    }
}
