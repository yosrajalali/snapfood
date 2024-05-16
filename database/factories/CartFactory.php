<?php

namespace Database\Factories;

use App\Models\Buyer;
use App\Models\Cart;
use App\Models\Food;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cart>
 */
class CartFactory extends Factory
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
            'food_id' => Food::query()->inRandomOrder()->first()->id,
            'count' => $this->faker->numberBetween(1, 10)
        ];
    }
}
