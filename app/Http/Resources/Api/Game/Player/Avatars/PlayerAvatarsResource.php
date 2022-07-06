<?php

namespace App\Http\Resources\Api\Game\Player\Avatars;

use App\EnumTypes\Avatar\AvatarTypeOfCost;
use App\Http\Resources\Api\Game\Player\Accessories\PlayerAccessoriesResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

class PlayerAvatarsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|JsonSerializable|Arrayable
     */
    #[ArrayShape(['id' => "mixed", 'color' => "mixed", 'surname' => "mixed", 'is_free' => "bool", 'level' => "mixed", 'nft_hash' => "mixed", 'is_nft' => "mixed", 'accessories' => "\Illuminate\Http\Resources\Json\AnonymousResourceCollection"])]
    public function toArray($request) : array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->uuid,
            'color' => $this->color,
            'surname' => $this->surname,
            'is_free' => $this->cost_type == AvatarTypeOfCost::Free,
            'level' => $this->level,
            'nft_hash' => $this->nft_hash,
            'is_nft' => $this->is_nft,
            'accessories' => PlayerAccessoriesResource::collection($this->accessories)
        ];
    }
}
