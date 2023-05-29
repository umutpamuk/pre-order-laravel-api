<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use Illuminate\Support\Collection;

interface OrderRepositoryInterface
{
    /**
     * @param $orderData
     * @return Order
     */
    public function createOrder($orderData) : Order;

    /**
     * @param $orderItemData
     * @return OrderItem
     */
    public function createOrderItem($orderItemData) : OrderItem;

    /**
     * @param $orderDetailData
     * @return OrderDetail
     */
    public function createOrderDetail($orderDetailData) : OrderDetail;

    /**
     * @param array $relationships
     * @return Collection
     */
    public function getAwaitingOrders(array $relationships = []) : Collection;

}
