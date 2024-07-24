<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'johndoe',
                'password' => Hash::make('password'),
                'full_name' => 'John Doe',
                'email' => 'john@example.com',
                'cpf' => '12345678901',
                'date_of_birth' => '1990-01-01',
                'reference' => 'ref123',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'janedoe',
                'password' => Hash::make('password'),
                'full_name' => 'Jane Doe',
                'email' => 'jane@example.com',
                'cpf' => '09876543210',
                'date_of_birth' => '1992-02-02',
                'reference' => 'ref456',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}