<?php

namespace App\Services\Order;

use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Product\ProductRepositoriesInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\ApiResponder;

class OrderService implements OrderServiceInterface
{
    use ApiResponder;

    /**
     * @var OrderRepositoryInterface
     */
    protected OrderRepositoryInterface $orderRepository;
    /**
     * @var CartRepositoryInterface
     */
    protected CartRepositoryInterface $cartRepository;
    /**
     * @var ProductRepositoriesInterface
     */
    protected ProductRepositoriesInterface $productRepositories;

    /**
     * @param OrderRepositoryInterface $orderRepository
     * @param CartRepositoryInterface $cartRepository
     * @param ProductRepositoriesInterface $productRepositories
     */
    public function __construct(
        OrderRepositoryInterface $orderRepository,
        CartRepositoryInterface $cartRepository,
        ProductRepositoriesInterface $productRepositories
    )
    {
     $this->orderRepository = $orderRepository;
     $this->cartRepository = $cartRepository;
     $this->productRepositories = $productRepositories;
    }

    /**
     * @param int $userId
     * @param string $token
     * @param int $totalAmount
     * @param $preOrderStoreRequest
     * @param $carts
     * @return JsonResponse
     */
    public function placeOrder(int $userId, string $token, int $totalAmount, $preOrderStoreRequest, $carts) : JsonResponse
    {
        try {
            DB::beginTransaction();

            $orderData = (object) [
                'userId' => $userId,
                'totalAmount' => $totalAmount,
            ];
            $order = $this->orderRepository->createOrder($orderData);

            $orderDetailData = (object) [
                'orderId' => $order->id,
                'firstName' => $preOrderStoreRequest->first_name,
                'lastName' => $preOrderStoreRequest->last_name,
                'email' => $preOrderStoreRequest->email,
                'phone' => $preOrderStoreRequest->phone,
                'address' => $preOrderStoreRequest->address
            ];
            $this->orderRepository->createOrderDetail($orderDetailData);

            foreach ($carts as $cart) {

                $stockDecrement = $this->productRepositories->stockDecrement($cart->product_id, $cart->quantity);

                if (!$stockDecrement) {
                    DB::rollBack();
                    return $this->sendError('Insufficient Stock : ' . $cart->name, Response::HTTP_BAD_REQUEST);
                }

                $orderItemData = (object) [
                    'orderId' => $order->id,
                    'productId' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'unitPrice' => $cart->unit_price,
                    'totalPrice' => $cart->total_price,
                ];
                $this->orderRepository->createOrderItem($orderItemData);
            }

            DB::commit();

            $this->cartRepository->remove($token);

            return $this->sendSuccess('Order created successfully.');

        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->sendError($exception->getMessage());
        }
    }

}
