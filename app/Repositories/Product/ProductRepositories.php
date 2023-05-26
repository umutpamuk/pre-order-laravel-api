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
}
