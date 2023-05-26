<?php

namespace App\Repositories\Cart;

interface CartRepositoryInterface
{

    /**
     * @param string $token
     * @return mixed
     */
    public function get(string $token);

    /**
     * @param string $token
     * @param array $cart
     * @param int $expTime
     * @return mixed
     */
    public function put(string $token, array $cart, int $expTime = 60);

    /**
     * @param int $productId
     * @param int $totalQuantity
     * @return bool
     */
    public function isTheStockEnough(int $productId, int $totalQuantity) : bool;

    /**
     * @param string $token
     * @return mixed
     */
    public function list(string $token);

    /**
     * @param string $token
     * @param int|null $productId
     * @return bool
     */
    public function remove(string $token, int $productId = null) : bool;

    /**
     * @param string $token
     * @param int $productId
     * @param int $quantity
     * @return bool
     */
    public function update(string $token, int $productId, int $quantity) : bool;

}
