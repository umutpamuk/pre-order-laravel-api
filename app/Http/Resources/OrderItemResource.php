<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
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
          'productName' => $this->product->name,
          'quantity' => $this->quantity,
          'stock' => $this->product->stock,
          'category' => $this->product->category->name,
          'unit_price' => $this->unit_price,
          'total_price' => $this->total_price,

        ];
    }
}
