<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('orders')->insert([
            [
                'user_id' => 1,
                'guest_id' => NULL,
                'order_date' => now(),
                'status' => 'pending',
                'shipping_method' => 'standard',
                'payment_method' => 'credit card',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => NULL,
                'guest_id' => 1,
                'order_date' => now(),
                'status' => 'completed',
                'shipping_method' => 'express',
                'payment_method' => 'paypal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('order_items')->insert([
            [
                'order_id' => 1,
                'product_id' => 1,
                'quantity' => 1,
                'price' => 19.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [            
                'order_id' => 2,
                'product_id' => 2,
                'quantity' => 2,
                'price' => 29.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('order_addresses')->insert([
            [
                'order_id' => 1,
                'type' => 'shipping',
                'address_line1' => '123 Main St',
                'address_line2' => '',
                'city' => 'New York',
                'state' => 'NY',
                'postal_code' => '10001',
                'country' => 'USA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2,
                'type' => 'payment',
                'address_line1' => '456 Another St',
                'address_line2' => 'Apt 2',
                'city' => 'San Francisco',
                'state' => 'CA',
                'postal_code' => '94105',
                'country' => 'USA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}