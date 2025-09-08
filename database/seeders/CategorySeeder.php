<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Electronics',
            'description' => 'Electronic gadgets and devices',
        ]);
        Category::create([
            'name' => 'Books',
            'description' => 'Various kinds of books',
        ]);
        Category::create([
            'name' => 'Clothing',
            'description' => 'Apparel and accessories',
        ]);
        Category::create([
            'name' => 'Home & Kitchen',
            'description' => 'Household items and kitchenware',
        ]);
        Category::create([
            'name' => 'Sports & Outdoors',
            'description' => 'Sporting goods and outdoor equipment',
        ]);
    }
}
