<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FootwearSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'THE CLOTHE5 5HOP Sneakers',
                'description' => '
                    <p>Step into everyday comfort and style with these classic low-top sneakers from <strong>THE CLOTHE5 5HOP</strong>, designed for versatility and effortless streetwear appeal.</p>

                    <ul>
                        <li>Sleek low-cut silhouette</li>
                        <li>Contrast side stripe detail</li>
                        <li>Signature gold TC5 branding</li>
                        <li>Lace-up fastening</li>
                        <li>Cushioned sole for daily comfort</li>
                    </ul>
                ',
                'base_price' => 10.00,
                'low_stock_threshold' => 5,
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(), 
            ],
            [
                'name' => 'THE CLOTHE5 5HOP Boots',
                'description' => '
                    <p>Built for durability and bold style, these combat boots from <strong>THE CLOTHE5 5HOP</strong> combine rugged design with refined detailing.</p>

                    <ul>
                        <li>High lace-up silhouette</li>
                        <li>Sturdy, supportive outsole</li>
                        <li>Black contrasting eyelets and stitching</li>
                        <li>Oversized TC5 side branding</li>
                        <li>Pull tab for easy on and off</li>
                    </ul>
                ',
                'base_price' => 10.00,
                'low_stock_threshold' => 5,
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(), 
            ],
            [
                'name' => 'THE CLOTHE5 5HOP Flats',
                'description' => '
                    <p>For minimal elegance and refined comfort, these pointed flats from <strong>THE CLOTHE5 5HOP</strong> offer a sleek profile perfect for both casual and formal looks.</p>

                    <ul>
                        <li>Modern pointed toe shape</li>
                        <li>Soft suede-like texture</li>
                        <li>Contrasting edge piping</li>
                        <li>Gold TC5 branding on insole</li>
                        <li>Lightweight slip-on design</li>
                    </ul>
                ',
                'base_price' => 10.00,
                'low_stock_threshold' => 5,
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(), 
            ],
            [
                'name' => 'THE CLOTHE5 5HOP Heels',
                'description' => '
                    <p>Make a statement with these sophisticated T-strap heels from <strong>THE CLOTHE5 5HOP</strong>, crafted for elegance and eye-catching detail.</p>

                    <ul>
                        <li>High stiletto heel</li>
                        <li>Glossy black finish</li>
                        <li>Gold TC5 emblem integrated into T-strap</li>
                        <li>Adjustable ankle buckle fastening</li>
                        <li>Sleek, modern silhouette for evening wear</li>
                    </ul>
                ',
                'base_price' => 10.00,
                'low_stock_threshold' => 5,
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(), 
            ],
            [
                'name' => 'THE CLOTHE5 5HOP Trainers',
                'description' => '
                    <p>Clean, modern, and versatile, these minimalist trainers from <strong>THE CLOTHE5 5HOP</strong> are perfect for everyday wear with premium comfort.</p>

                    <ul>
                        <li>Low-top classic shape</li>
                        <li>Premium textured finish</li>
                        <li>Gold TC5 side branding</li>
                        <li>Lace-up closure</li>
                        <li>Cushioned sole for all-day support</li>
                    </ul>
                ',
                'base_price' => 18,
                'low_stock_threshold' => 5,
                'category_id' => 3, 
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
