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
            'first_name' => 'system',
            'last_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '1234567890', // Assuming phone is a string field
            'role' => 'admin',
            'password' => Hash::make('password'), // Use Hash facade to hash password
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
