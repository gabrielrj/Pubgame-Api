<?php

namespace App\Http\Resources\Api\Game\Player\Avatars;

use Illuminate\Http\Resources\Json\JsonResource;

class PlayerAvatarsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
