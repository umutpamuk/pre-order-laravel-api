<?php

namespace App\Http\Controllers;

use App\Http\Requests\PreOrderApproveRequest;
use App\Http\Requests\PreOrderStoreRequest;
use App\Services\Cart\CartService;
use App\Services\Order\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponder;

class PreOrderController extends Controller
{
    use ApiResponder;

    /**
     * @var CartService
     */
    protected CartService $cartService;
    /**
     * @var OrderService
     */
    protected OrderService $orderService;

    /**
     * @param CartService $cartService
     * @param OrderService $orderService
     */
    public function __construct(
        CartService $cartService,
        OrderService $orderService
    )
    {
        $this->cartService = $cartService;
        $this->orderService = $orderService;
    }

    public function index()
    {
        return $this->orderService->getAwaitingOrdersJson();
    }

    public function approve(PreOrderApproveRequest $preOrderApproveRequest)
    {
        //
    }

    /**
     * @param PreOrderStoreRequest $preOrderStoreRequest
     * @return JsonResponse
     */
    public function store(PreOrderStoreRequest $preOrderStoreRequest) : JsonResponse
    {
        $user  = Auth::user();
        $token = $user->currentAccessToken()->token;

        $getCartData  = $this->cartService->list($token)->getData()->data;

        if (!$getCartData) {
            return $this->sendError('Your cart product was not found.');
        }

        $carts = $getCartData->cart;
        $totalAmount = $getCartData->total_amount;

        return $this->orderService->placeOrder($user->id, $token, $totalAmount, $preOrderStoreRequest, $carts);
    }
}
