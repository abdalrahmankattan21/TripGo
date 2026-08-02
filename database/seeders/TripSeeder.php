<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Destination;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
{

        $trips = [];
        for ($i = 0; $i < 10; $i++) {
        $startDate = Carbon::now()->addDays(($i * 7) + 10);
        $endDate = (clone $startDate)->addDays(rand(5, 8));
        $totalSeats = rand(15, 30);

        $trips[$i] =
            [
                'title' =>  "Trip " . ($i + 1),
                'description' => fake()->text(),
                'image' => 'image',
                'departure_point' => fake()->address(),
                'destination_id' => Destination::inRandomOrder()->value('id'),
                'category_id'=> Category::inRandomOrder()->value('id') ,
                'price' => fake()->numberBetween(100,200),
                'start_date' => $startDate,
                'end_date' => $endDate,
                'booking_cancel_deadline' => (clone $startDate)->subDays(2),
                'total_seats' => $totalSeats,
                'available_seats' => $totalSeats,
                'status' => 'scheduled',
            ];
        }
        foreach($trips as $trip) {
            Trip::create($trip);

    }
}
}
