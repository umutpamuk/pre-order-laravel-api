<?php

namespace App\Services\Cart;

use Illuminate\Http\JsonResponse;

interface CartServiceInterface
{

    /**
     * @param string $token
     * @return JsonResponse
     */
    public function list(string $token) : JsonResponse;

    /**
     * @param string $token
     * @param int $productId
     * @param int $quantity
     * @return JsonResponse
     */
    public function add(string $token, int $productId, int $quantity) : JsonResponse;

    /**
     * @param string $token
     * @param int $productId
     * @param int $quantity
     * @return JsonResponse
     */
    public function update(string $token, int $productId, int $quantity) : JsonResponse;

    /**
     * @param string $token
     * @param int|null $productId
     * @return JsonResponse
     */
    public function remove(string $token, int $productId = null) : JsonResponse;


}
