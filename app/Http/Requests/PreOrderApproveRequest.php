<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PreOrderApproveRequest extends FormRequest
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
            'order_id' => 'required|integer|exists:orders,id'
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'order_id.required' => 'The Order ID field is required.',
            'order_id.integer' => 'The Order ID field must be an integer.',
            'order_id.exists' => 'The specified order ID must belong to a valid order.',
            'order_id.orders.id' => 'The Order ID is not a valid order ID.',
        ];
    }

}
