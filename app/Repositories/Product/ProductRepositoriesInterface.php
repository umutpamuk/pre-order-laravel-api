<?php

namespace App\Repositories\Product;

use App\Models\Product;
use Illuminate\Support\Collection;

interface ProductRepositoriesInterface
{

    /**
     * @return Collection
     */
    public function all() : Collection;

    /**
     * @return Collection
     */
    public function allAvailable() : Collection;

    /**
     * @param int $id
     * @return Product
     */
    public function findOrFail(int $id) : Product;

    /**
     * @param int $productId
     * @param int $quantity
     * @return bool
     */
    public function stockDecrement(int $productId, int $quantity) : bool;

}
