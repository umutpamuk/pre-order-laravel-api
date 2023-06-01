<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductsTest extends TestCase
{
    /**
     * @return void
     */
    public function test_get_products() : void
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

    /**
     * @return void
     */
    public function test_get_products_available() : void
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
