<?php

namespace App\Services\Cart;

use App\Repositories\Cart\CartRepositoryInterface;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponder;
use Symfony\Component\HttpFoundation\Response;

class CartService implements CartServiceInterface
{
    use ApiResponder;

    /**
     * @var CartRepositoryInterface
     */
    protected CartRepositoryInterface $cartRepository;

    /**
     * @param CartRepositoryInterface $cartRepository
     */
    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    /**
     * @param string $token
     * @return JsonResponse
     */
    public function list(string $token) : JsonResponse
    {
        $list = $this->cartRepository->list($token);

        return $this->sendResponse($list ?? []);
    }

    /**
     * @param string $token
     * @param int $productId
     * @param int $quantity
     * @return JsonResponse
     */
    public function add(string $token, int $productId, int $quantity) : JsonResponse
    {
        if ($quantity <= 0) {
            return $this->sendError(
                'The quantity to be entered must be greater than 0.',
                Response::HTTP_BAD_REQUEST
            );
        }
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

    /**
     * @param string $token
     * @param int $productId
     * @param int $quantity
     * @return JsonResponse
     */
    public function update(string $token, int $productId, int $quantity) : JsonResponse
    {
        $updateCart = $this->cartRepository->update($token, $productId, $quantity);

        if ($updateCart) {
            return $this->sendSuccess('Card Updated');
        } else {
            return $this->sendError('Card Update Failed');
        }
    }

    /**
     * @param string $token
     * @param int|null $productId
     * @return JsonResponse
     */
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
