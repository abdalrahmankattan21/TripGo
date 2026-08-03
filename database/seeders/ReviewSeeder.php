<?php

namespace Database\Seeders;

use App\Models\Booking;
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
        $trips = Trip::where('status', 'completed')->get();
        foreach($trips as $trip) {
          $bookings =  Booking::where('status', 'confirmed')->where('trip_id', $trip->id)->get();

            foreach($bookings as $booking) {
            Review::create([
                'trip_id' => $trip->id,
                'user_id' => $booking->user_id,
                'rating' => rand(1, 5),
                'comment' => 'The is a comment',
            ]);

          }

        }

    }
}
