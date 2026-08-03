<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompletedTripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trip = Trip::create([
            'title' =>  "completed Trip",
                'description' => fake()->text(),
                'image' => 'image',
                'departure_point' => fake()->address(),
                'destination_id' => Destination::inRandomOrder()->value('id'),
                'category_id'=> Category::inRandomOrder()->value('id') ,
                'price' => fake()->numberBetween(100,200),
                'start_date' => now()->subDays(20),
                'end_date' => now()->subDays(10),
                'booking_cancel_deadline' => now()->subDays(22),
                'total_seats' => 30,
                'available_seats' => 25,
                'status' => 'completed',
        ]);
        $users = User::inRandomOrder()->limit(5)->get();
        for($i = 0; $i < 5; $i++) {
              Booking::create([
                    'user_id' => $users[$i]->id,
                    'trip_id' => $trip->id,
                    'seats' => 1,
                    'total_price' => $trip->price,
                    'status' => 'confirmed',
                    'booked_at' => $trip->booking_cancel_deadline->subDays(3),
                ]);

        }
    }
}
