<?php

namespace App\Http\Resources\Api\Game\Player\Finance\Deposit;

use Illuminate\Http\Resources\Json\JsonResource;

class BUSDDepositHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->uuid,
            'blockchain_hash_operation' => $this->blockchain_hash_operation,
            'coin' => $this->coin_type->name,
            'coin_acronym' => $this->coin_type->acronym,
            'amount' => $this->amount,
            'registered_at' => $this->created_at->format('Y/m/d H:i'),
            'status' => $this->deposit_status,
            'last_update' => $this->updated_at->format('Y/m/d H:i'),
        ];
    }
}
