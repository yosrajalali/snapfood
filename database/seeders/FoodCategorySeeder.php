<?php

namespace Database\Seeders;

use App\Models\FoodCategory;
use App\Models\RestaurantCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'فست فود',
            'سنتی',
            'دریایی',
            'ایتالیایی',
            'دسرها'
        ];

        foreach ($categories as $category) {
            FoodCategory::create([
                'category_name' => $category
            ]);
        }
    }
}
