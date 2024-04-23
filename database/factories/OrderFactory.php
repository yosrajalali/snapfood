<?php

namespace Database\Factories;

use App\Models\Buyer;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'buyer_id' => Buyer::query()->inRandomOrder()->first()->id,
            'restaurant_id' => Restaurant::query()->inRandomOrder()->first()->id,
            'status_id' => OrderStatus::query()->inRandomOrder()->first()->id,
            'total_price' => $this->faker->randomFloat(2, 10, 500), // Prices between 10.00 and 500.00
        ];
    }
}
