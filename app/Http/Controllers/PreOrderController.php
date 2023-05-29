<?php

namespace App\Http\Controllers;

use App\Http\Requests\PreOrderApproveRequest;
use App\Http\Requests\PreOrderStoreRequest;
use App\Services\Cart\CartService;
use App\Services\Order\OrderService;
use App\Services\Twilio\TwilioService;
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
     * @var TwilioService
     */
    protected TwilioService $twilioService;


    /**
     * @param CartService $cartService
     * @param OrderService $orderService
     * @param TwilioService $twilioService
     */
    public function __construct(
        CartService $cartService,
        OrderService $orderService,
        TwilioService $twilioService
    )
    {
        $this->cartService = $cartService;
        $this->orderService = $orderService;
        $this->twilioService = $twilioService;
    }

    /**
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        return $this->orderService->getAwaitingOrdersJson();
    }

    /**
     * @param PreOrderApproveRequest $preOrderApproveRequest
     * @return JsonResponse
     */
    public function awaitingToApprove(PreOrderApproveRequest $preOrderApproveRequest) : JsonResponse
    {
        $order = $this->orderService->awaitingToApprove($preOrderApproveRequest->order_id);

        if ($order) {
            $message = 'Order_id :  '.$order->id.' Approved Successfully';

            $this->twilioService->sendSms($order->orderDetail->phone, $message);

           return $this->sendSuccess($message);
        }

        return $this->sendError('Order Not Approved.');

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
