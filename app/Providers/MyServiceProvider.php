<?php

namespace App\Providers;

use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\Product\ProductRepositories;
use App\Repositories\Product\ProductRepositoriesInterface;
use App\Services\Cart\CartService;
use App\Services\Cart\CartServiceInterface;
use App\Services\Product\ProductService;
use App\Services\Product\ProductServiceInterface;
use Illuminate\Support\ServiceProvider;

class MyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(CartServiceInterface::class, CartService::class);
        app()->bind(CartRepositoryInterface::class, CartRepository::class);

        app()->bind(ProductServiceInterface::class, ProductService::class);
        app()->bind(ProductRepositoriesInterface::class, ProductRepositories::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}