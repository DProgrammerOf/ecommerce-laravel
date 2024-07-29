<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            GuestsTableSeeder::class,
            ProductsTableSeeder::class,
            CartsTableSeeder::class,
            OrdersTableSeeder::class,
            OAuthClients::class,
            OAuthPersonalAccessClients::class
        ]);
    }
}
