<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
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
            [
                'first_name' => 'Hamza',
                'last_name' => 'Awad',
                'email' => 'hamzaawad04@outlook.com',
                'email_verified_at' => now(),
                'password' => bcrypt('hamza'),
                'role' => 'admin',
                'phone' => '00',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
                        [
                'first_name' => 'Thomas',
                'last_name' => 'Harvey',
                'email' => 'tomharvey@outlook.com',
                'email_verified_at' => now(),
                'password' => bcrypt('tom'),
                'role' => 'admin',
                'phone' => '01',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
                        [
                'first_name' => 'Kawthar',
                'last_name' => 'Karim',
                'email' => 'kawtharkarim@outlook.com',
                'email_verified_at' => now(),
                'password' => bcrypt('kawther'),
                'role' => 'admin',
                'phone' => '02',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'first_name' => 'Uzair',
                'last_name' => 'Butt',
                'email' => 'uzairbutt@outlook.com',
                'email_verified_at' => now(),
                'password' => bcrypt('uzair'),
                'role' => 'customer',
                'phone' => '03',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
                        [
                'first_name' => 'Aliyan',
                'last_name' => 'Ramday',
                'email' => 'aliyanramday@outlook.com',
                'email_verified_at' => now(),
                'password' => bcrypt('aliyan'),
                'role' => 'admin',
                'phone' => '04',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
                        [
                'first_name' => 'Basimah',
                'last_name' => 'Mah',
                'email' => 'basimahmah@outlook.com',
                'email_verified_at' => now(),
                'password' => bcrypt('basimah'),
                'role' => 'admin',
                'phone' => '05',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
                        [
                'first_name' => 'Cameron',
                'last_name' => 'Swaby',
                'email' => 'cameronswaby@outlook.com',
                'email_verified_at' => now(),
                'password' => bcrypt('cameron'),
                'role' => 'admin',
                'phone' => '06',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
                        [
                'first_name' => 'Mimi',
                'last_name' => '',
                'email' => 'mimi@outlook.com',
                'email_verified_at' => now(),
                'password' => bcrypt('mimi'),
                'role' => 'admin',
                'phone' => '07',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
        User::factory()->count(50)->create();
    }
}
