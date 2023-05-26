<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Services\Cart\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * @var CartService
     */
    protected CartService $cartService;

    /**
     * @param CartService $cartService
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * @return JsonResponse
     */
    public function list() : JsonResponse
    {
      $token = Auth::user()->currentAccessToken()->token;

      return $this->cartService->list($token);
    }

    /**
     * @param CartRequest $cartRequest
     * @return JsonResponse
     */
    public function add(CartRequest $cartRequest) : JsonResponse
    {
        $token = Auth::user()->currentAccessToken()->token;

        return $this->cartService->add(
            $token,
            $cartRequest->input('product_id'),
            $cartRequest->input('quantity')
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function remove(Request $request) : JsonResponse
    {
        $token = Auth::user()->currentAccessToken()->token;

        return $this->cartService->remove(
            $token,
            $request->product_id ?? null
        );
    }

    /**
     * @param CartUpdateRequest $cartUpdateRequest
     * @return JsonResponse
     */
    public function update(CartUpdateRequest $cartUpdateRequest) : JsonResponse
    {
        $token = Auth::user()->currentAccessToken()->token;

        return $this->cartService->update(
            $token,
            $cartUpdateRequest->input('product_id'),
            $cartUpdateRequest->input('quantity')
        );
    }
}
