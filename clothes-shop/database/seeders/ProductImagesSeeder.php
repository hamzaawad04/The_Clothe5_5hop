<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImagesSeeder extends Seeder
{
    public function run(): void
    {
        $getId = function ($name) {
            $product = DB::table('products')->where('name', $name)->first();
            if (!$product) {
                throw new \Exception("Product not found: " . $name);
            }
            return $product->product_id;
        };

        DB::table('product_images')->insert([
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Polo Shirt'),
                'url' => 'images/tops/polofront.png',
                'is_primary' => 1
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Polo Shirt'),
                'url' => 'images/tops/poloback.png',
                'is_primary' => 0
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Button-Up Shirt'),
                'url' => 'images/tops/buttonupshirtfront.png',
                'is_primary' => 1
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Button-Up Shirt'),
                'url' => 'images/tops/buttonupshirtback.png',
                'is_primary' => 0
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP T-Shirt'),
                'url' => 'images/tops/tshirtfront.png',
                'is_primary' => 1
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP T-Shirt'),
                'url' => 'images/tops/tshirtback.png',
                'is_primary' => 0
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Jumper'),
                'url' => 'images/tops/jumperfront.png',
                'is_primary' => 1
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Jumper'),
                'url' => 'images/tops/jumperback.png',
                'is_primary' => 0
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Hoodie'),
                'url' => 'images/tops/hoodiefront.png',
                'is_primary' => 1
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Hoodie'),
                'url' => 'images/tops/hoodieback.png',
                'is_primary' => 0
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Sneakers'),
                'url' => 'images/footwear/vanspair.png',
                'is_primary' => 1
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Sneakers'),
                'url' => 'images/footwear/vansside.png',
                'is_primary' => 0
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Boots'),
                'url' => 'images/footwear/bootspair.png',
                'is_primary' => 1
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Boots'),
                'url' => 'images/footwear/bootsfront.png',
                'is_primary' => 0
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Boots'),
                'url' => 'images/footwear/bootsside.png',
                'is_primary' => 0
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Flats'),
                'url' => 'images/footwear/flatspair.png',
                'is_primary' => 1
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Flats'),
                'url' => 'images/footwear/flatsfront.png',
                'is_primary' => 0
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Flats'),
                'url' => 'images/footwear/flatsside.png',
                'is_primary' => 0
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Heels'),
                'url' => 'images/footwear/heelspair.png',
                'is_primary' => 1
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Heels'),
                'url' => 'images/footwear/heelleft.png',
                'is_primary' => 0
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Heels'),
                'url' => 'images/footwear/heelsside.png',
                'is_primary' => 0
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Trainers'),
                'url' => 'images/footwear/whitetrainerspair.png',
                'is_primary' => 1
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Trainers'),
                'url' => 'images/footwear/whitetrainers.png',
                'is_primary' => 0
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Chinos'),
                'url' => 'images/bottoms/chinosfront.png',
                'is_primary' => 1
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Chinos'),
                'url' => 'images/bottoms/chinosback.png',
                'is_primary' => 0
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Shorts'),
                'url' => 'images/bottoms/shortsfront.png',
                'is_primary' => 1
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Shorts'),
                'url' => 'images/bottoms/shortsback.png',
                'is_primary' => 0
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Cargo Trousers'),
                'url' => 'images/bottoms/cargosfront.png',
                'is_primary' => 1
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Cargo Trousers'),
                'url' => 'images/bottoms/cargosback.png',
                'is_primary' => 0
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Joggers'),
                'url' => 'images/bottoms/joggersfront.png',
                'is_primary' => 1
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Joggers'),
                'url' => 'images/bottoms/joggersback.png',
                'is_primary' => 0
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Jeans'),
                'url' => 'images/bottoms/jeansfront.png',
                'is_primary' => 1
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Jeans'),
                'url' => 'images/bottoms/jeansback.png',
                'is_primary' => 0
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Blazer'),
                'url' => 'images/outerwear/blazerfront.png',
                'is_primary' => 1
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Blazer'),
                'url' => 'images/outerwear/blazerback.png',
                'is_primary' => 0
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Denim Jacket'),
                'url' => 'images/outerwear/denimjacketfront.png',
                'is_primary' => 1
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Denim Jacket'),
                'url' => 'images/outerwear/denimjacketback.png',
                'is_primary' => 0
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Puffer Jacket'),
                'url' => 'images/outerwear/wintercoatsfront.png',
                'is_primary' => 1
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Puffer Jacket'),
                'url' => 'images/outerwear/wintercoatsback.png',
                'is_primary' => 0
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Overcoat'),
                'url' => 'images/outerwear/overcoatfront.png',
                'is_primary' => 1
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Overcoat'),
                'url' => 'images/outerwear/overcoatback.png',
                'is_primary' => 0
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Cardigan'),
                'url' => 'images/outerwear/cardiganfront.png',
                'is_primary' => 1
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Cardigan'),
                'url' => 'images/outerwear/cardiganback.png',
                'is_primary' => 0
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Scarf'),
                'url' => 'images/accessories/scarf.png',
                'is_primary' => 1
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Scarf'),
                'url' => 'images/accessories/scarfback.png',
                'is_primary' => 0
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Watch'),
                'url' => 'images/accessories/watch.png',
                'is_primary' => 1
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Watch'),
                'url' => 'images/accessories/watchback.png',
                'is_primary' => 0
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Glasses'),
                'url' => 'images/accessories/glasses.png',
                'is_primary' => 1
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Glasses'),
                'url' => 'images/accessories/glassesback.png',
                'is_primary' => 0
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Gloves'),
                'url' => 'images/accessories/gloves.png',
                'is_primary' => 1
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Gloves'),
                'url' => 'images/accessories/glovesright.png',
                'is_primary' => 0
            ],

            [
                'product_id' => $getId('THE CLOTHE5 5HOP Necklace'),
                'url' => 'images/accessories/necklaceonstand.png',
                'is_primary' => 1
            ],
            [
                'product_id' => $getId('THE CLOTHE5 5HOP Necklace'),
                'url' => 'images/accessories/necklace.png',
                'is_primary' => 0
            ],
        ]);
    }
}
