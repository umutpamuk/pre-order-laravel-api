<?php

namespace App\Services\Order;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

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
    public function placeOrder(int $userId, string $token, int $totalAmount, $preOrderStoreRequest, $carts
    ) : JsonResponse;

    /**
     * @param array $relationships
     * @return Collection
     */
    public function getAwaitingOrders(array $relationships = []) : Collection;

    /**
     * @return JsonResponse
     */
    public function getAwaitingOrdersJson() : JsonResponse;

    /**
     * @param int $orderId
     * @return Order|null
     */
    public function awaitingToApprove(int $orderId): ?Order;
}
