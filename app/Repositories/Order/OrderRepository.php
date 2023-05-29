<?php

namespace App\Repositories\Order;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use Illuminate\Support\Collection;

class OrderRepository implements OrderRepositoryInterface
{

    /**
     * @param $orderData
     * @return Order
     */
    public function createOrder($orderData) : Order
    {
        return Order::create([
            'user_id' => $orderData->userId,
            'total_amount' => $orderData->totalAmount,
            'status' => OrderStatusEnum::AWAITING,
        ]);
    }

    /**
     * @param $orderItemData
     * @return OrderItem
     */
    public function createOrderItem($orderItemData) : OrderItem
    {
        return OrderItem::create([
            'order_id' => $orderItemData->orderId,
            'product_id' => $orderItemData->productId,
            'quantity' => $orderItemData->quantity,
            'unit_price' => $orderItemData->unitPrice,
            'total_price' => $orderItemData->totalPrice,
        ]);
    }

    /**
     * @param $orderDetailData
     * @return OrderDetail
     */
    public function createOrderDetail($orderDetailData) : OrderDetail
    {
        return OrderDetail::create([
            'order_id' => $orderDetailData->orderId,
            'first_name' => $orderDetailData->firstName,
            'last_name' => $orderDetailData->lastName,
            'email' => $orderDetailData->email,
            'phone' => $orderDetailData->phone,
            'address' => $orderDetailData->address
        ]);
    }

    /**
     * @param array $relationships
     * @return Collection
     */
    public function getAwaitingOrders(array $relationships = []) : Collection
    {
        if ($relationships) {
            return Order::with($relationships)->where('status', OrderStatusEnum::AWAITING)->get();
        } else {
            return Order::where('status', OrderStatusEnum::AWAITING)->get();
        }
    }

}
