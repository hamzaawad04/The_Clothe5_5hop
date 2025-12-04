<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Tops',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bottoms',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Footwear',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Outerwear',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Accessories',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
