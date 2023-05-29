<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductsTest extends TestCase
{
    /** @test */
    public function test_get_products()
    {
        $response = $this->get(route('products.index'))
            ->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'category_id',
                    'category_name',
                    'price',
                    'stock',
                ]
            ]
        ]);
    }

    /** @test */
    public function test_get_products_available()
    {
        $response = $this->get(route('products.available'))
            ->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'category_id',
                    'category_name',
                    'price',
                    'stock',
                ]
            ]
        ]);
    }
}
