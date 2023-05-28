<?php

namespace App\Services\Order;

use Illuminate\Http\JsonResponse;

interface OrderServiceInterface
{
    /**
     * @param int $userId
     * @param string $token
     * @param int $totalAmount
     * @param $preOrderStoreRequest
     * @param $carts
     * @return JsonResponse
     */
    public function placeOrder(int $userId, string $token, int $totalAmount, $preOrderStoreRequest, $carts) : JsonResponse;
}
