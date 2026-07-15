<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    DB::table('destinations')->insert([
        ['name' => 'Paris', 'city' => 'France', 'description' => 'AL-Noor city', 'image' => 'paris.jpg', 'created_at' => now(), 'updated_at' => now()],
        ['name' => 'Istanbul', 'city' => 'Turky', 'description' => 'Al-Karten city', 'image' => 'istanbul.jpg', 'created_at' => now(), 'updated_at' => now()],
    ]);
}
}
