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
        ['name' => 'Paris', 'description' => 'AL-Noor city', 'image' => 'image'],
        ['name' => 'Istanbul', 'description' => 'Al-Karten city', 'image' =>'image'],
    ]);
}
}
