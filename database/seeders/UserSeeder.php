<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => "admin",
            'email' => "admin@gmail.com",
            'phone' => fake()->phoneNumber(),
            'password' => Hash::make("admin"),
            'is_admin' => 1
        ]);

        // Normal users
        User::factory(10)->create();
    }
}
