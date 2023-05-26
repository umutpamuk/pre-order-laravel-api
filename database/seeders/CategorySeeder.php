<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryJsonFile = Storage::get('data/categories.json');

        $categories = json_decode($categoryJsonFile);

        foreach ($categories as $category) {
            Category::create([
                'id' => $category->id,
                'name' => $category->name,
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
