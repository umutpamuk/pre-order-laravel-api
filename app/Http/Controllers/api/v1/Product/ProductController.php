<?php

namespace App\Http\Controllers\api\v1\Product;

use App\Http\Controllers\Controller;
use App\Services\Product\ProductService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    protected ProductService $productService;

    /**
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index() : AnonymousResourceCollection
    {
        return $this->productService->all();
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function available() : AnonymousResourceCollection
    {
        return $this->productService->allAvailable();
    }
}
