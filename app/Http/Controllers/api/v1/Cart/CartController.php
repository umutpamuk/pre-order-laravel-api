<?php

namespace App\Http\Controllers\api\v1\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Services\Cart\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected CartService $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function list()
    {
      $token = Auth::user()->currentAccessToken()->token;

      return $this->cartService->list($token);
    }

    public function add(CartRequest $cartRequest)
    {
        $token = Auth::user()->currentAccessToken()->token;

        return $this->cartService->add($token, $cartRequest->input('product_id'), $cartRequest->input('quantity'));
    }

    public function remove(Request $request)
    {
        $token = Auth::user()->currentAccessToken()->token;

        return $this->cartService->remove($token, $request->productId ?? null);
    }

    public function update(CartUpdateRequest $cartUpdateRequest)
    {
        $token = Auth::user()->currentAccessToken()->token;

        return $this->cartService->update($token, $cartUpdateRequest->input('product_id'), $cartUpdateRequest->input('quantity'));
    }
}
