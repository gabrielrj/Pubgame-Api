<?php

namespace App\Http\Resources\Api\Game\AcquisitionOfBox;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class AccessoryResource extends JsonResource
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
            'engagement_date_in_avatar' => $this->engagement_date_in_avatar,
            'is_pending_payment' => $this->is_pending_payment,
            'name' => $this->accessory->name,
            'type' => $this->accessory->type->name,
            'rarity' => $this->accessory->rarity->name,
            //Skill
            'sk' => $this->accessory->skill->code . '|' . $this->accessory->skill->name,
            //Modifier
            'md' => $this->accessory->modifier,
            'edition' => $this->accessory->edition,
            'is_free' => $this->accessory->is_free,
        ];
    }
}
