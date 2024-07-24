<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuestsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('guests')->insert([
            [
                'session_id' => 'session123',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'session_id' => 'session456',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}