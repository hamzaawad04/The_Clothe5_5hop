<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessoriesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'THE CLOTHE5 5HOP Scarf',
                'description' => '
                    <p>Wrap yourself in warmth and understated luxury with this premium wool scarf from <strong>THE CLOTHE5 5HOP</strong>. Designed for comfort and crafted with a sleek minimalist finish, it’s the perfect cold-weather essential.</p>

                    <ul>
                        <li>Soft brushed wool texture</li>
                        <li>Fringed hem detailing</li>
                        <li>Signature gold TC5 logo accent</li>
                        <li>Lightweight yet warm</li>
                        <li>Versatile styling for everyday wear</li>
                    </ul>
                ',
                'base_price' => 10.00,
                'low_stock_threshold' => 5,
                'category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(), 
            ],
            [
                'name' => 'THE CLOTHE5 5HOP Watch',
                'description' => '
                    <p>Timeless precision meets modern sophistication in the <strong>THE CLOTHE5 5HOP</strong> Classic Steel Watch. Built for durability and style, it brings a refined finish to any look.</p>

                    <ul>
                        <li>Stainless-steel bracelet and case</li>
                        <li>Black dial with polished hour markers</li>
                        <li>Date window display</li>
                        <li>Engraved TC5 crown emblem</li>
                        <li>Everyday water-resistant design</li>
                    </ul>
                ',
                'base_price' => 10.00,
                'low_stock_threshold' => 5,
                'category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(), 
            ],
            [
                'name' => 'THE CLOTHE5 5HOP Glasses',
                'description' => '
                    <p>Add a touch of intellectual edge with these retro-inspired square glasses from <strong>THE CLOTHE5 5HOP</strong>. With a bold frame and gold detailing, they elevate both casual and smart outfits.</p>

                    <ul>
                        <li>Classic square-frame silhouette</li>
                        <li>Gloss black finish</li>
                        <li>Gold TC5 temple logo</li>
                        <li>Comfort nose pads for all-day wear</li>
                        <li>Lightweight, durable construction</li>
                    </ul>
                ',
                'base_price' => 10.00,
                'low_stock_threshold' => 5,
                'category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(), 
            ],
            [
                'name' => 'THE CLOTHE5 5HOP Gloves',
                'description' => '
                    <p>These premium leather gloves from <strong>THE CLOTHE5 5HOP</strong> deliver warmth, comfort, and refined sophistication—perfect for the winter season.</p>

                    <ul>
                        <li>Soft, full-grain leather</li>
                        <li>Elegant stitching details</li>
                        <li>Gold TC5 emblem</li>
                        <li>Warm inner lining</li>
                        <li>Classic slim-fit design</li>
                    </ul>
                ',
                'base_price' => 10.00,
                'low_stock_threshold' => 5,
                'category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(), 
            ],
            [
                'name' => 'THE CLOTHE5 5HOP Necklace',
                'description' => '
                    <p>Crafted with a bold woven structure, this <strong>THE CLOTHE5 5HOP</strong> gold chain necklace adds statement elegance to any outfit—perfect for smart or casual styling.</p>

                    <ul>
                        <li>Premium gold-tone finish</li>
                        <li>Intricate woven chain design</li>
                        <li>Lightweight and durable</li>
                        <li>Minimalist clasp closure</li>
                        <li>Ideal for layering or solo wear</li>
                    </ul>
                ',
                'base_price' => 18,
                'low_stock_threshold' => 5,
                'category_id' => 5, 
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
