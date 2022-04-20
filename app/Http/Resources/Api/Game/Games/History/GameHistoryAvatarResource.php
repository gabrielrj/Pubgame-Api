<?php

namespace App\Http\Resources\Api\Game\Games\History;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class GameHistoryAvatarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|JsonSerializable|Arrayable
     */
    public function toArray($request) : array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->uuid,
            'surname' => $this->surname,
            'last_game' => $this->last_game_date->format('Y-m-d H:i'),
        ];
    }
}
