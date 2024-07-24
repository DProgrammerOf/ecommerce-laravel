<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            [
                'product_name' => 'Product 1',
                'description' => 'Description for Product 1',
                'price' => 19.99,
                'stock' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Product 2',
                'description' => 'Description for Product 2',
                'price' => 29.99,
                'stock' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}