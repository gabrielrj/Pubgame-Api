<?php

namespace App\Http\Resources\Api\Game\Shop;

use App\EnumTypes\Accessory\AccessoryEdition;
use App\EnumTypes\Box\BoxCostType;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

class BoxesListResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'is_free' => $this->cost_type == BoxCostType::Free,
            'available_for_sale' => $this->available_for_sale,
            'quantity_for_sale' => $this->quantity_for_sale <= 0 ? 0 : $this->quantity_for_sale,
            'accessory_edition' => $this->accessory_edition == AccessoryEdition::DefaultEdition ? 'Default' : 'Special',
            'price' => $this->price,
            'price_coin' => $this->coin_type != null ? ($this->coin_type?->acronym . ' | ' . $this->coin_type?->name) : null
        ];
    }
}
