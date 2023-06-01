<?php

namespace App\Repositories\Cart;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class CartRepository implements CartRepositoryInterface
{

    /**
     * @param string $token
     * @return array|mixed
     */
    public function get(string $token)
    {
        $cacheKey = 'cart:' . $token;

        return Cache::get($cacheKey);
    }

    /**
     * @param string $token
     * @param array $cart
     * @param int $expTime
     * @return void
     */
    public function put(string $token, array $cart, int $expTime = 6000)
    {
        $cacheKey = 'cart:' . $token;

        Cache::put($cacheKey, $cart, $expTime);
    }

    /**
     * @param int $productId
     * @param int $totalQuantity
     * @return bool
     */
    public function isTheStockEnough(int $productId, int $totalQuantity) : bool
    {
        return $this->findOrFail($productId)->stock >= $totalQuantity;
    }

    /**
     * @param int $productId
     * @return Product|null
     */
    public function findOrFail(int $productId) : ?Product
    {
        return Product::findOrFail($productId);
    }

    /**
     * @param string $token
     * @return array|null
     */
    public function list(string $token) : ?array
    {
        $carts = $this->get($token) ?? [];

        $resourceData = null;
        $totalAmount = 0;
        foreach ($carts as $productId => $quantity) {

            $product = $this->findOrFail($productId);

            $stockControl = $this->isTheStockEnough($product->id, $quantity);

            if (!$stockControl) {
                unset($carts[$product->id]);
                $this->put($token, $carts);

                continue;
            }

            $resourceData[] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'quantity' => $quantity,
                'unit_price' => $product->price,
                'total_price' => $quantity * $product->price,
            ];

            $totalAmount += $quantity * $product->price;
        }

        if ($resourceData) {
            return ['cart' => $resourceData, 'total_amount' => $totalAmount];
        } else {
            return null;
        }
    }

    /**
     * @param string $token
     * @param int|null $productId
     * @return bool
     */
    public function remove(string $token, int $productId = null) : bool
    {
        $cart = $this->get($token);

        if (!empty($cart)) {

            if ($productId) {

                if (!isset($cart[$productId])) {
                    return  false;
                }

                unset($cart[$productId]);
                $this->put($token, $cart);

            } else {
                $this->put($token, []);
            }
            $response = true;
        } else {
            $response = false;
        }

        return $response;

    }

    /**
     * @param string $token
     * @param int $productId
     * @param int $quantity
     * @return bool
     */
    public function update(string $token, int $productId, int $quantity) : bool
    {
        $cart = $this->get($token);

        if ($cart) {

            $cart[$productId] = $quantity;

            $this->put($token, $cart);

            return true;

        } else {
            return false;
        }
    }
}
