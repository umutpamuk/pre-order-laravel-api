<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !empty(Auth::user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => 'required|integer',
            'quantity' => 'required|integer'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $productId = $this->input('product_id');
            $quantity = $this->input('quantity');

            $product = Product::find($productId);

            if (!$product) {
                $validator->errors()->add('product_id', 'The selected product does not exist.');
            } elseif ($quantity > $product->stock) {
                $validator->errors()->add('quantity', 'The quantity entered is not valid for the selected product.');
            }
        });
    }

}
