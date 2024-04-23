<?php

namespace Database\Factories;

use App\Models\Restaurant;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'seller_id' => Seller::query()->inRandomOrder()->first()->id,
            'name' => $this->faker->company,
            'type' => $this->faker->randomElement(['فست فود', 'سنتی', 'کافه', 'دریایی']),
            'phone_number' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'bank_account_number' => $this->faker->bankAccountNumber,
            'is_complete' => $this->faker->boolean(80)  // 80% chance that 'is_complete' is true
        ];
    }
}
