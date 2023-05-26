<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{

    /**
     * @param $request
     * @return array
     */
    public function toArray(Request $request)
    {
        return [
            'name' => $request->data->name,
            'quantity' => $request->quantity,
            'unit_price' => $request->data->price,
            'total_price' => $request->quantity * $request->data->price,
        ];
    }
}
