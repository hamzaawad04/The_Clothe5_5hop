<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class scaleTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'theocratic',
                'description' => 'lorem ipsum',
                'base_price' => 20,
                'low_stock_threshold' => 5,
                'category_id' => 1,
            ],
        ]);
    }
}
