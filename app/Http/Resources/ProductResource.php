<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    /**
     * @param $request
     * @return array
     */
    public function toArray($request) : array
    {
        return [
          'id' => $this->id,
          'name' => $this->name,
          'category_id' => $this->category_id,
          'category_name' => $this->category->name,
          'price' => $this->price,
          'stock' => $this->stock,
        ];
    }
}
