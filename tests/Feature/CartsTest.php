<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CartsTest extends TestCase
{
    /**
     * @return void
     */
    public function test_cart_add() : void
    {
        $product = Product::first();
        $user    = User::first();

        $formData = [
            'product_id' => $product->id,
            'quantity'   => $product->stock - 1,
        ];

        Sanctum::actingAs($user, ['*']);

        $response = $this->post(route('cart.add'), $formData, [
            'Authorization' => 'Bearer ' . $user->createToken('API Token')->plainTextToken,
        ]);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_cart_list() : void
    {
        $user = User::first();

        Sanctum::actingAs($user, ['*']);

        $response = $this->get(route('cart.list'), [
            'Authorization' => 'Bearer ' . $user->createToken('API Token')->plainTextToken,
        ]);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_cart_update() : void
    {
        $product = Product::first();
        $user    = User::first();

        $formData = [
            'product_id' => $product->id,
            'quantity'   => $product->stock - 1,
        ];

        Sanctum::actingAs($user, ['*']);

        $this->post(route('cart.add'), $formData, [
            'Authorization' => 'Bearer ' . $user->createToken('API Token')->plainTextToken,
        ]);

        $formData = [
            'product_id' => $product->id,
            'quantity'   => $product->stock - 2,
        ];

        $response = $this->post(route('cart.update'), $formData, [
            'Authorization' => 'Bearer ' . $user->createToken('API Token')->plainTextToken,
        ]);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_cart_remove() : void
    {
        $product = Product::first();
        $user    = User::first();

        $formData = [
            'product_id' => $product->id,
            'quantity'   => $product->stock - 1,
        ];

        Sanctum::actingAs($user, ['*']);

        $this->post(route('cart.add'), $formData, [
            'Authorization' => 'Bearer ' . $user->createToken('API Token')->plainTextToken,
        ]);

        $response = $this->post(route('cart.remove'), [
            'Authorization' => 'Bearer ' . $user->createToken('API Token')->plainTextToken,
        ]);

        $response->assertStatus(200);
    }
}
