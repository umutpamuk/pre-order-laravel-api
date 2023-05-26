<?php

namespace App\Repositories\Cart;

interface CartRepositoryInterface
{

    public function get(string $token);

    public function put(string $token, array $cart, int $expTime = 60);

    public function isTheStockEnough(int $productId, int $totalQuantity) : bool;

    public function list(string $token);

    public function remove(string $token, int $productId = null) : bool;

}
