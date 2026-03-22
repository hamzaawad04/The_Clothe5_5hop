<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\OrderStatus;
use App\Models\Order;
use App\Models\OrderItem;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the factory's model
     */
    protected $model = Order::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        $user = User::inRandomOrder()->first() ?? User::factory()->create();

        return [
            'user_id' => $user -> user_id,
            'status' => fake()->randomElement(OrderStatus::cases()),
            'total_amount' => 0, //calculated later
            'ship_name' => $user -> first_name . ' ' . $user -> last_name,
            'ship_address' => fake() -> address(),
            'payment_method' => 'credit_card',
            'order_date' => now(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($order) {

            $items = OrderItem::factory()
                ->count(rand(1, 3))
                ->create([
                    'order_id' => $order -> order_id
                ]);

            $total = $items->sum(function ($item) {
                return $item->line_total;
            });

            $order->update(['total_amount' => $total]);
        });
    }
}
