<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OuterwearSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'THE CLOTHE5 5HOP Blazer',
                'description' => '
                    <p>Refine your smart wardrobe with this tailored blazer from <strong>THE CLOTHE5 5HOP</strong>, crafted for a polished and confident look.</p>

                    <ul>
                        <li>Structured tailored fit</li>
                        <li>Notch lapel design</li>
                        <li>Buttoned cuffs</li>
                        <li>Single rear vent for movement</li>
                        <li>Minimal embroidered TC5 logo</li>
                    </ul>
                ',
                'base_price' => 10.00,
                'low_stock_threshold' => 5,
                'category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(), 
            ],
            [
                'name' => 'THE CLOTHE5 5HOP Denim Jacket',
                'description' => '
                    <p>A timeless wardrobe essential, this denim jacket from <strong>THE CLOTHE5 5HOP</strong> blends classic styling with everyday comfort.</p>

                    <ul>
                        <li>Classic button-up front</li>
                        <li>Twin chest pockets with flap closures</li>
                        <li>Adjustable waist tabs</li>
                        <li>Vintage-inspired stitching details</li>
                        <li>Relaxed casual fit</li>
                    </ul>
                ',
                'base_price' => 10.00,
                'low_stock_threshold' => 5,
                'category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(), 
            ],
            [
                'name' => 'THE CLOTHE5 5HOP Puffer Jacket',
                'description' => '
                    <p>Stay warm without compromising style in this insulated puffer jacket from <strong>THE CLOTHE5 5HOP</strong>, perfect for colder days.</p>

                    <ul>
                        <li>Quilted padded design</li>
                        <li>Adjustable hood for added warmth</li>
                        <li>Full-zip closure with snap-over placket</li>
                        <li>Side pockets for convenience</li>
                        <li>Subtle embroidered TC5 chest logo</li>
                    </ul>
                ',
                'base_price' => 10.00,
                'low_stock_threshold' => 5,
                'category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(), 
            ],
            [
                'name' => 'THE CLOTHE5 5HOP Overcoat',
                'description' => '
                    <p>Elevate your outerwear collection with this sophisticated overcoat from <strong>THE CLOTHE5 5HOP</strong>, designed for refined, structured styling.</p>

                    <ul>
                        <li>Classic longline silhouette</li>
                        <li>Three-button fastening</li>
                        <li>Front flap pockets</li>
                        <li>Notched lapels for a tailored finish</li>
                        <li>Discrete tone-on-tone TC5 chest embroidery</li>
                    </ul>
                ',
                'base_price' => 10.00,
                'low_stock_threshold' => 5,
                'category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(), 
            ],
            [
                'name' => 'THE CLOTHE5 5HOP Cardigan',
                'description' => '
                    <p>A versatile layering piece, this button-up cardigan from <strong>THE CLOTHE5 5HOP</strong> delivers comfort and understated style.</p>

                    <ul>
                        <li>Deep V-neckline</li>
                        <li>Button-down front</li>
                        <li>Ribbed cuffs and hem</li>
                        <li>Soft knit texture</li>
                        <li>Relaxed everyday fit</li>
                    </ul>
                ',
                'base_price' => 18,
                'low_stock_threshold' => 5,
                'category_id' => 4, 
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
