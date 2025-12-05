<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'first_name' => 'Harry',
                'last_name' => 'Du Bois',
                'email' => 'tequilasunset@live.com',
                'email_verified_at' => now(),
                'password' => bcrypt('revachol'),
                'role' => 'customer',
                'phone' => '44',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'first_name' => 'Hourglass',
                'last_name' => 'Twins',
                'email' => 'outerwildsventures@live.com',
                'email_verified_at' => now(),
                'password' => bcrypt('hearthian'),
                'role' => 'admin',
                'phone' => '22',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
