<?php

namespace Database\Seeders;

use App\Models\Guide;
use App\Models\Trip;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuideTripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guides = Guide::all();
        $trips = Trip::all();

        foreach ($guides as $guide) {
            $guide->trips()->attach(
                $trips->random(rand(1, 3))->pluck('id')->toArray()
            );
        }
    }
}
