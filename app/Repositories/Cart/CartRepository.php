<?php

namespace App\Repositories\Cart;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class CartRepository implements CartRepositoryInterface
{
    public function get(string $token)
    {
        $cacheKey = 'cart:' . $token;

        return Cache::get($cacheKey);
    }

    public function put(string $token, array $cart, int $expTime = 600)
    {
        $cacheKey = 'cart:' . $token;

        Cache::put($cacheKey, $cart, $expTime);
    }

    public function isTheStockEnough(int $productId, int $totalQuantity) : bool
    {
        return $this->findOrFail($productId)->stock >= $totalQuantity;
    }

    public function findOrFail(int $productId)
    {
        return Product::findOrFail($productId);
    }

    public function list(string $token)
    {
        $carts = $this->get($token) ?? [];

        $resourceData = null;
        $totalAmount = 0;
        foreach ($carts as $productId => $quantity) {

            $product = $this->findOrFail($productId);

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
