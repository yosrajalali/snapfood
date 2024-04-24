<?php

namespace Database\Factories;

use App\Models\Food;
use App\Models\FoodCategory;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Food>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'restaurant_id' => Restaurant::query()->pluck('id')->random(),
            'name' => $this->faker->word,
            'ingredients' => $this->faker->sentence,
            'price' => $this->faker->numberBetween(10000, 50000),
            'image' => $this->faker->imageUrl(640, 480, 'food', true),
            'category_id' => FoodCategory::query()->pluck('id')->random()
        ];
    }
}
