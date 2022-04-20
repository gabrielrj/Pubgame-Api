<?php

namespace App\Http\Resources\Api\Game\Games\History;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class GameHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->uuid,
            'type' => $this->type->name,
            'table' => $this->pub_table->name,
            'time_game' => $this->created_at->format('H:i') . '(UTC)',
            'date_game' => $this->created_at->format('Y-m-d') . '(UTC)',
            'game_status' => $this->status_game,
            'reward_pub_coin_earned' => $this->pub_coin_earned,
            'reward_claim_status' => $this->status_claim,
            'avatar' => new GameHistoryAvatarResource($this->avatar),
            'avatar_level' => $this->avatar_level,
            'avatar_total_accessories' => $this->number_of_avatar_accessories,

        ];
    }
}
