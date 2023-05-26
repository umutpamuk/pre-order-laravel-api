<?php

namespace App\Services\Cart;

interface CartServiceInterface
{

    public function list(string $token);
    public function add(string $token, int $productId, int $quantity);
    public function update(int $productId, int $quantity);
    public function remove(string $token, int $productId = null);


}
