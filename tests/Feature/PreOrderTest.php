<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PreOrderTest extends TestCase
{
    use WithFaker;

    /**
     * @return void
     */
    public function test__post_pre_order() : void
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

        $preOrderData = [
            'first_name' => $this->faker->firstName,
            'last_name'   => $this->faker->lastName,
            'email'   => $user->email,
            'phone'   => $this->faker->e164PhoneNumber,
            'address'   => $this->faker->address,
        ];

        $response = $this->post(route('pre-order.store'), $preOrderData, [
            'Authorization' => 'Bearer ' . $user->createToken('API Token')->plainTextToken,
        ]);

        $response->assertStatus(200);
    }


    /**
     * @return void
     */
    public function test_get_pre_order() : void
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

        $preOrderData = [
            'first_name' => $this->faker->firstName,
            'last_name'   => $this->faker->lastName,
            'email'   => $user->email,
            'phone'   => $this->faker->e164PhoneNumber,
            'address'   => $this->faker->address,
        ];

        $this->post(route('pre-order.store'), $preOrderData, [
            'Authorization' => 'Bearer ' . $user->createToken('API Token')->plainTextToken,
        ]);

        $response = $this->get(route('pre-orders.index'), [
            'Authorization' => 'Bearer ' . $user->createToken('API Token')->plainTextToken,
        ]);

        $response->assertStatus(200);
    }


    /**
     * @return void
     */
    public function test_post_pre_order_approve() : void
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

        $preOrderData = [
            'first_name' => $this->faker->firstName,
            'last_name'   => $this->faker->lastName,
            'email'   => $user->email,
            'phone'   => $this->faker->e164PhoneNumber,
            'address'   => $this->faker->address,
        ];

        $this->post(route('pre-order.store'), $preOrderData, [
            'Authorization' => 'Bearer ' . $user->createToken('API Token')->plainTextToken,
        ]);

       $order = Order::first();

       $approveData = [
           'order_id' => $order->id
       ];
        $response = $this->post(route('pre-order.approve'), $approveData, [
            'Authorization' => 'Bearer ' . $user->createToken('API Token')->plainTextToken,
        ]);

        $response->assertStatus(200);
    }
}
