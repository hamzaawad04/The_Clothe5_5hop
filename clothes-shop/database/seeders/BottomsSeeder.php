<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BottomsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'THE CLOTHE5 5HOP Chinos',
                'description' => '
                    <p>Refine your everyday wardrobe with these modern chinos from <strong>THE CLOTHE5 5HOP</strong>, offering a clean, versatile look that works for any occasion.</p>

                <ul>
                    <li>Slim tapered silhouette</li>
                    <li>Classic side and back pockets</li>
                    <li>Belt loops for a tailored finish</li>
                    <li>Minimalist TC5 embroidery detail</li>
                    <li>Designed for smart-casual styling</li>
                </ul>
                ',
                'base_price' => 10.00,
                'low_stock_threshold' => 5,
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(), 
            ],
            [
                'name' => 'THE CLOTHE5 5HOP Shorts',
                'description' => '
                    <p>Lightweight, sharp, and effortlessly stylish — these tailored shorts from 
                    <strong>THE CLOTHE5 5HOP</strong> bring a refined edge to warm-weather outfits.</p>

                    <ul>
                        <li>Above-knee tailored fit</li>
                        <li>Functional side and welt pockets</li>
                        <li>Secure button and zip fastening</li>
                        <li>Subtle tonal TC5 logo embroidery</li>
                        <li>Perfect for casual and smart-casual looks</li>
                    </ul>
                ',
                'base_price' => 10.00,
                'low_stock_threshold' => 5,
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(), 
            ],
            [
                'name' => 'THE CLOTHE5 5HOP Cargo Trousers',
                'description' => '
                    <p>Durable and utility-inspired, these cargo trousers from <strong>THE CLOTHE5 5HOP</strong> blend practicality with contemporary streetwear style.</p>

                    <ul>
                        <li>Relaxed straight-leg fit</li>
                        <li>Dual cargo pockets for utility</li>
                        <li>Discrete TC5 logo on the hip</li>
                        <li>Reinforced stitching for durability</li>
                        <li>Ideal for everyday and outdoor wear</li>
                    </ul>
                ',
                'base_price' => 10.00,
                'low_stock_threshold' => 5,
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(), 
            ],
            [
                'name' => 'THE CLOTHE5 5HOP Joggers',
                'description' => '
                    <p>Engineered for comfort, these joggers from <strong>THE CLOTHE5 5HOP</strong> deliver a clean, modern look without sacrificing ease of movement.</p>

                    <ul>
                        <li>Tapered leg with elasticated cuffs</li>
                        <li>Adjustable drawstring waistband</li>
                        <li>Soft, smooth interior finish</li>
                        <li>Embroidered TC5 logo on thigh</li>
                        <li>Perfect for lounging and everyday wear</li>
                    </ul>
                ',
                'base_price' => 10.00,
                'low_stock_threshold' => 5,
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(), 
            ],
            [
                'name' => 'THE CLOTHE5 5HOP Jeans',
                'description' => '
                    <p>Classic meets contemporary with these straight-leg jeans from <strong>THE CLOTHE5 5HOP</strong>, designed for everyday versatility.</p>

                    <ul>
                        <li>Straight-leg silhouette</li>
                        <li>Traditional five-pocket construction</li>
                        <li>Mid-rise for comfortable wear</li>
                        <li>Washed finish for a timeless look</li>
                        <li>Signature TC5 embroidery on pocket</li>
                    </ul>
                ',
                'base_price' => 18,
                'low_stock_threshold' => 5,
                'category_id' => 2, 
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
