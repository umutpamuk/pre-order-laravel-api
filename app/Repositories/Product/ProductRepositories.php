<?php

namespace App\Repositories\Product;

use App\Models\Product;
use \Illuminate\Support\Collection;

class ProductRepositories implements ProductRepositoriesInterface
{

    /**
     * @return Collection
     */
    public function all() : Collection
    {
        return Product::with('category')->get();

    }

    /**
     * @return Collection
     */
    public function allAvailable(): Collection
    {
        return Product::where('stock', '>', 0)->with('category')->get();

    }

    /**
     * @param int $id
     * @return Product
     */
    public function findOrFail(int $id): Product
    {
        return Product::findOrFail($id);
    }

    /**
     * @param int $productId
     * @param int $quantity
     * @return bool
     */
    public function stockDecrement(int $productId, int $quantity) : bool
    {
        $product = $this->findOrFail($productId);

        if ($product->stock >= $quantity) {

            $product->decrement('stock', $quantity);

            return true;

        } else {

          return false;

        }
    }
}
