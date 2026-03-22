<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\ProductVariant;
use App\Models\OrderItem;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the factory's model
     */
    protected $model = OrderItem::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $variant = ProductVariant::inRandomOrder() -> firstOrFail();
        $qty = fake() -> numberBetween(1, 3);
        $price = $variant -> product -> base_price;

        return [
            'order_id' => Order::factory(),
            'product_id' => $variant -> product_id,
            'variant_id' => $variant->variant_id,
            'unit_price' => $price,
            'qty' => $qty,
            'line_total' => $price * $qty
        ];
    }
}
