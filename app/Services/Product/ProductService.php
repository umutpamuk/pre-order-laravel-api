<?php

namespace App\Services\Product;

use App\Http\Resources\ProductResource;
use App\Repositories\Product\ProductRepositoriesInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductService implements ProductServiceInterface
{
    /**
     * @var ProductRepositoriesInterface
     */
    protected ProductRepositoriesInterface $productRepositories;

    /**
     * @param ProductRepositoriesInterface $productRepositories
     */
    public function __construct(ProductRepositoriesInterface $productRepositories)
    {
     $this->productRepositories = $productRepositories;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function all(): AnonymousResourceCollection
    {
        return ProductResource::collection($this->productRepositories->all());
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function allAvailable(): AnonymousResourceCollection
    {
        return ProductResource::collection($this->productRepositories->allAvailable());
    }
}
