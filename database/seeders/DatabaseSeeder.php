<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Buyer;
use App\Models\FoodCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SellerSeeder::class,
            BuyerSeeder::class,
            RestaurantCategorySeeder::class,
            FoodCategorySeeder::class,
            RestaurantSeeder::class,
            OrderStatusSeeder::class,
            FoodSeeder::class,
            OrderSeeder::class,
            DiscountSeeder::class
        ]);
    }
}
