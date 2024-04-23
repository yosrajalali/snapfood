<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'در حال بررسی',
            'در حال اماده سازی',
            'ارسال به مقصد',
            'تحویل گرفته شد',

        ];

        foreach ($statuses as $status) {
            OrderStatus::create([
                'name' => $status
            ]);
        }
    }

}
