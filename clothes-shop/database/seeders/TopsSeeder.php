<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'THE CLOTHE5 5HOP Polo',
                'description' => '
                    <p>Keep your everyday style sharp with this classic polo shirt from <strong>THE CLOTHE5 5HOP</strong>.</p>
                    <ul>
                        <li>Polo collar</li>
                        <li>Two-button placket</li>
                        <li>Short sleeves</li>
                        <li>Embroidered TC5 logo</li>
                        <li>Regular fit</li>
                    </ul>
                ',
                'base_price' => 10.00,
                'low_stock_threshold' => 5,
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(), 
            ],
            [
                'name' => 'THE CLOTHE5 5HOP Button-Up Shirt',
                'description' => '
                    <p>Elevate your smart-casual wardrobe with this premium button-up shirt from <strong>THE CLOTHE5 5HOP</strong>, designed for versatility and modern style.</p>

                    <ul>
                        <li>Button-down collar</li>
                        <li>Full front button placket</li>
                        <li>Long sleeves with button cuffs</li>
                        <li>Embroidered TC5 logo on chest</li>
                        <li>Regular tailored fit</li>
                    </ul>
                ',
                'base_price' => 15,
                'low_stock_threshold' => 5,
                'category_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'THE CLOTHE5 5HOP T-Shirt',
                'description' => '
                    <p>A wardrobe essential, this signature black T-shirt from <strong>THE CLOTHE5 5HOP</strong> delivers comfort, style, and iconic branding in one piece.</p>

                    <ul>
                        <li>Classic crew neckline</li>
                        <li>Short sleeves</li>
                        <li>Bold gold TC5 chest logo</li>
                        <li>Regular athletic fit</li>
                    </ul>
                ',
                'base_price' => 15,
                'low_stock_threshold' => 5,
                'category_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'THE CLOTHE5 5HOP Jumper',
                'description' => '
                    <p>This refined V-neck jumper from <strong>THE CLOTHE5 5HOP</strong> blends comfort and elegance, making it a staple for cooler seasons.</p>

                    <ul>
                        <li>V-neckline</li>
                        <li>Ribbed cuffs and hem</li>
                        <li>Gold embroidered TC5 chest logo</li>
                        <li>Classic regular fit</li>
                    </ul>
                ',
                'base_price' => 20,
                'low_stock_threshold' => 5,
                'category_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'THE CLOTHE5 5HOP Hoodie',
                'description' => '
                    <p>Stay warm and stylish with this essential black hoodie from <strong>THE CLOTHE5 5HOP</strong>, designed for comfort without compromising on design.</p>

                    <ul>
                        <li>Adjustable drawstring hood</li>
                        <li>Front kangaroo pocket</li>
                        <li>Statement gold TC5 chest logo</li>
                        <li>Soft fleece interior</li>
                        <li>Relaxed fit</li>
                    </ul>
                ',
                'base_price' => 18,
                'low_stock_threshold' => 5,
                'category_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}