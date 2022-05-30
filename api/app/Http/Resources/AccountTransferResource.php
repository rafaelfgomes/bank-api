<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountTransferResource extends JsonResource
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
            'origin' => [
                'id' => $this['origin']['account_id'],
                'balance' => $this['origin']['balance']
            ],
            'destination' => [
                'id' => $this['destination']['account_id'],
                'balance' => $this['destination']['balance']
            ],
        ];
    }
}
