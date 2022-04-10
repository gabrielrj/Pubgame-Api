<?php

namespace App\Http\Resources\Api\Game\AcquisitionOfBox;

use App\EnumTypes\Avatar\AvatarTypeOfCost;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

class AvatarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */

    #[ArrayShape(['id' => "string", 'color' => "string", 'surname' => "string", 'is_free' => "bool", 'level' => "string"])]
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->uuid,
            'color' => $this->color,
            'surname' => $this->surname,
            'is_free' => $this->cost_type == AvatarTypeOfCost::Free,
            'level' => $this->level,
        ];
    }
}
