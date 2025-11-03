<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
      
            AdminUserSeeder::class,
            PricingSeeder::class,
            EcommerceDataSeeder::class,
            BlogSeeder::class, // ✅ Add BlogSeeder here
        ]);

       
    }
}