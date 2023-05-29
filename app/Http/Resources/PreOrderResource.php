<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PreOrderResource extends JsonResource
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
            'order_id' => $this->id,
            'total_amount' => $this->total_amount,
            'status' => $this->status,
            'orderDetail' => new OrderDetailResource($this->orderDetail),
            'orderItems' => OrderItemResource::collection($this->orderItems),
        ];
    }
}
