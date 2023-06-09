<?php

namespace App\Providers;

use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Product\ProductRepositories;
use App\Repositories\Product\ProductRepositoriesInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\Cart\CartService;
use App\Services\Cart\CartServiceInterface;
use App\Services\Order\OrderService;
use App\Services\Order\OrderServiceInterface;
use App\Services\Product\ProductService;
use App\Services\Product\ProductServiceInterface;
use App\Services\Twilio\TwilioService;
use App\Services\Twilio\TwilioServiceInterface;
use App\Services\User\UserService;
use App\Services\User\UserServiceInterface;
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

        app()->bind(OrderServiceInterface::class, OrderService::class);
        app()->bind(OrderRepositoryInterface::class, OrderRepository::class);

        app()->bind(TwilioServiceInterface::class, TwilioService::class);

        app()->bind(UserRepositoryInterface::class, UserRepository::class);
        app()->bind(UserServiceInterface::class, UserService::class);
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
