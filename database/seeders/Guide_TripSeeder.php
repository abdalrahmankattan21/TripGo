<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Guide_TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trips = \App\Models\Trip::all();
        $guides = \App\Models\Guide::all();

        foreach ($trips as $trip) {
            // Randomly select a guide for each trip
            $guide = $guides->random();
            $trip->guide()->attach($guide->id);
        }
    }
}
