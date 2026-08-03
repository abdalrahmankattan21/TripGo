<?php

namespace Database\Seeders;

use App\Models\Destination;
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
    Destination::insert([
        ['name' => 'Paris', 'description' => 'AL-Noor city', 'image' => 'image', 'created_at' => now(), 'updated_at' => now()],
        ['name' => 'Istanbul', 'description' => 'Al-Karten city', 'image' =>'image', 'created_at' => now(), 'updated_at' => now()],
    ]);
}
}
