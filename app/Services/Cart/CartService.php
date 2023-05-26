<?php

namespace App\Services\Cart;

use App\Http\Resources\CartResource;
use App\Models\Product;
use App\Repositories\Cart\CartRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Traits\ApiResponder;
use Symfony\Component\HttpFoundation\Response;

class CartService implements CartServiceInterface
{
    use ApiResponder;

    protected CartRepositoryInterface $cartRepository;

    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function list(string $token)
    {
        $list = $this->cartRepository->list($token);

        return $this->sendResponse($list ?? []);
    }

    public function add(string $token, int $productId, int $quantity)
    {
        $cart = $this->cartRepository->get($token) ?? [];

        if (array_key_exists($productId, $cart)) {

            $cart[$productId] += $quantity;

        } else {

            $cart[$productId] = $quantity;
        }

        $isTheStockEnough = $this->cartRepository->isTheStockEnough($productId, $cart[$productId]);

        if (!$isTheStockEnough) {

            return $this->sendError(
                'The product could not be added. Insufficient stock.',
                Response::HTTP_BAD_REQUEST
            );
        }

        try {
            $this->cartRepository->put($token, $cart);

            return $this->sendSuccess('Product Added');

        } catch (\Exception $exception) {

            return $this->sendError($exception->getMessage(), $exception->getCode());

        }

    }

    public function update(int $productId, int $quantity)
    {
        // TODO: Implement updateCart() method.
    }

    public function remove(string $token, int $productId = null) : JsonResponse
    {
        $clearCart = $this->cartRepository->remove($token, $productId);

        if ($clearCart) {
            return $this->sendSuccess('Card Cleared');
        } else {
            return $this->sendError('Card Deletion Failed');
        }
    }
}
