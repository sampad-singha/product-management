<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'MacBook Pro',
            'description' => 'Apple MacBook Pro 16-inch with M1 Pro chip',
            'price' => 2499.99,
        ]);
        Product::create([
            'name' => 'Dell XPS 13',
            'description' => 'Dell XPS 13 with Intel i7 processor',
            'price' => 1399.99,
        ]);
        Product::create([
            'name' => 'iPhone 13',
            'description' => 'Apple iPhone 13 with A15 Bionic chip',
            'price' => 799.99,
        ]);
        //clothing
        Product::create([
            'name' => 'Men\'s T-Shirt',
            'description' => '100% cotton, available in various sizes and colors',
            'price' => 19.99,
        ]);
        Product::create([
            'name' => 'Women\'s Jeans',
            'description' => 'Slim fit, stretch denim jeans',
            'price' => 49.99,
        ]);
        //home kitchen electric appliances
        Product::create([
            'name' => 'Instant Pot Duo 7-in-1',
            'description' => 'Electric pressure cooker, slow cooker, rice cooker, steamer, sauté pan, yogurt maker, and warmer',
            'price' => 89.99,
        ]);
        Product::create([
            'name' => 'Dyson V11 Torque Drive',
            'description' => 'Cordless vacuum cleaner with powerful suction and advanced filtration',
            'price' => 599.99,
        ]);
    }
}
