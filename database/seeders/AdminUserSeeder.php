<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Add this line for Hash facade

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        // Insert admin user data
        DB::table('users')->insert([
            'first_name' => 'Kenedy',
            'last_name' => 'Kipkirui',
            'email' => 'kened.k24@gmail.com',
            'phone' => '1234567890', // Assuming phone is a string field
            'role' => 'admin',
            'password' => Hash::make('123456'), // Use Hash facade to hash password
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
