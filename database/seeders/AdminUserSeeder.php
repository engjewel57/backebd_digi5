<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Check if admin already exists
        $existingAdmin = User::where('phone', '01700000000')->orWhere('email', 'admin@smecube.com')->first();
        
        if (!$existingAdmin) {
            User::create([
                'name' => 'Admin User',
                'phone' => '01700000000',
                'email' => 'admin@smecube.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone_verified_at' => now(),
            ]);

            $this->command->info('Admin user created successfully!');
            $this->command->info('Phone: 01700000000');
            $this->command->info('Use OTP: 12345 for demo login');
        } else {
            $this->command->info('Admin user already exists. Phone: ' . $existingAdmin->phone);
        }
    }
}