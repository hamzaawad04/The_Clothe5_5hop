<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariantsSeeder extends Seeder
{
    public function run(): void
    {
        $getId = function ($name) {
            $product = DB::table('products')->where('name', $name)->first();
            if (!$product) {
                throw new \Exception("Product not found for variant seeding: " . $name);
            }
            return $product->product_id;
        };

        DB::table('product_variants')->insert([
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Polo Shirt'),
                'size' => 'S',
                'colour' => 'Beige',
                'stock_qty' => 10
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Polo Shirt'),
                'size' => 'M',
                'colour' => 'Beige',
                'stock_qty' => 10
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Polo Shirt'),
                'size' => 'L',
                'colour' => 'Beige',
                'stock_qty' => 10
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Button-Up Shirt'),
                'size' => 'S',
                'colour' => 'White',
                'stock_qty' => 8
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Button-Up Shirt'),
                'size' => 'M',
                'colour' => 'White',
                'stock_qty' => 8
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Button-Up Shirt'),
                'size' => 'L',
                'colour' => 'White',
                'stock_qty' => 8
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP T-Shirt'),
                'size' => 'S',
                'colour' => 'Black',
                'stock_qty' => 12
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP T-Shirt'),
                'size' => 'M',
                'colour' => 'Black',
                'stock_qty' => 12
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP T-Shirt'),
                'size' => 'L',
                'colour' => 'Black',
                'stock_qty' => 12
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Jumper'),
                'size' => 'M',
                'colour' => 'Grey',
                'stock_qty' => 6
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Hoodie'),
                'size' => 'M',
                'colour' => 'Black',
                'stock_qty' => 9
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Sneakers'),
                'size' => '8',
                'colour' => 'Black/White',
                'stock_qty' => 7
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Boots'),
                'size' => '9',
                'colour' => 'Brown',
                'stock_qty' => 5
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Flats'),
                'size' => '5',
                'colour' => 'Tan',
                'stock_qty' => 10
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Heels'),
                'size' => '6',
                'colour' => 'Black',
                'stock_qty' => 4
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Trainers'),
                'size' => '8',
                'colour' => 'White',
                'stock_qty' => 10
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Chinos'),
                'size' => '32',
                'colour' => 'Navy',
                'stock_qty' => 10
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Shorts'),
                'size' => 'M',
                'colour' => 'Khaki',
                'stock_qty' => 12
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Cargo Trousers'),
                'size' => 'L',
                'colour' => 'Olive',
                'stock_qty' => 8
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Joggers'),
                'size' => 'M',
                'colour' => 'Dark Grey',
                'stock_qty' => 15
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Jeans'),
                'size' => '32',
                'colour' => 'Blue Denim',
                'stock_qty' => 9
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Blazer'),
                'size' => 'M',
                'colour' => 'Black',
                'stock_qty' => 4
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Denim Jacket'),
                'size' => 'L',
                'colour' => 'Blue',
                'stock_qty' => 6
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Puffer Jacket'),
                'size' => 'L',
                'colour' => 'Charcoal',
                'stock_qty' => 5
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Overcoat'),
                'size' => 'M',
                'colour' => 'Camel',
                'stock_qty' => 3
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Cardigan'),
                'size' => 'M',
                'colour' => 'Beige',
                'stock_qty' => 7
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Scarf'),
                'size' => 'One Size',
                'colour' => 'Grey',
                'stock_qty' => 12
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Watch'),
                'size' => 'One Size',
                'colour' => 'Silver',
                'stock_qty' => 6
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Glasses'),
                'size' => 'One Size',
                'colour' => 'Black',
                'stock_qty' => 10
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Gloves'),
                'size' => 'M',
                'colour' => 'Dark Brown',
                'stock_qty' => 8
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Necklace'),
                'size' => 'One Size',
                'colour' => 'Gold',
                'stock_qty' => 5
            ],
        ]);
    }
}
