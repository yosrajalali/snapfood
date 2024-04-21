<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->admin()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'phone_number' => '000-000-0000',
            'password' => bcrypt('adminpassword')
        ]);

        // Create multiple buyer and seller users
        User::factory(10)->create();
    }
}
