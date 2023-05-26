<?php

namespace Database\Seeders;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productJsonFile = Storage::get('data/products.json');

        $products = json_decode($productJsonFile);

        foreach ($products as $product) {
            Product::create([
                'id' => $product->id,
                'name' => $product->name,
                'category_id' => $product->category,
                'price' => $product->price,
                'stock' => $product->stock,
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
