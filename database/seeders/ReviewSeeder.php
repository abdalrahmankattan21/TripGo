<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Trip;
use App\Models\Review;


class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trips = Trip::all();
        foreach ($trips as $trip) {
            Review::create([
                'trip_id' => $trip->id,
                'user_id' => User::inRandomOrder()->first()->id,
                'rating' => rand(1, 5),
                'comment' => 'تعليق عشوائي على الرحلة',
            ]);
        }
    }
}
