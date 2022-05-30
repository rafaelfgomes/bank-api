<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountWithdrawResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if (!empty($this->resource)) {
            return [
                'origin' => [
                    'id' => $this['account_id'],
                    'balance' => $this['balance']
                ]
            ];
        }

        return 0;
    }
}
