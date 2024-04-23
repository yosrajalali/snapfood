<?php

namespace Database\Seeders;

use App\Models\RestaurantCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'رستوران',
            'سنتی',
            'دریایی',
            'ایتالیایی'
        ];

        foreach ($categories as $category) {
            RestaurantCategory::create([
                'category_name' => $category
            ]);
        }
    }
}
