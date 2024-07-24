<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('carts')->insert([
            [
                'user_id' => 1,
                'guest_id' => NULL,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'guest_id' => NULL,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('cart_items')->insert([
            [
                'cart_id' => 1,
                'product_id' => 1,
                'quantity' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cart_id' => 2,
                'product_id' => 2,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}