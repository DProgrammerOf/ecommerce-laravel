<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Roles
     */
    private int $ROLE_ADMIN = 9;
    private int $ROLE_MANAGER_PRODUCT = 1;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            [
                'username' => 'admin',
                'password' => Hash::make('123456'),
                'email' => 'admin@email.com',
                'role' => $this->ROLE_ADMIN,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'manager',
                'password' => Hash::make('123456'),
                'email' => 'manager@email.com',
                'role' => $this->ROLE_MANAGER_PRODUCT,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
