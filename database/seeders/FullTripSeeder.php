<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Category;
use App\Models\Companion;
use App\Models\Destination;
use App\Models\Trip;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FullTripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $users = User::take(5)->get();

            if ($users->count() < 5) {
                return;
            }


        // Create Full Trip

            $trip = Trip::create([
                'name' => "Full Trip to Paris",
                'title' => "Full Trip ",
                'description' => 'Enjoy a wonderful trip to Paris.',
                'departure_point' => fake()->address(),
                'start_date' => now()->addDays(10),
                'end_date' =>  now()
                    ->addDays(10)
                    ->addHours(5),
                'booking_cancel_deadline' => now(),
                'total_seats' => 5,
                'available_seats' => 5,
                'price' => fake()->numberBetween(100,200),
                'status' => 'active',
                'destination_id' => Destination::inRandomOrder()->value('id'),
                'category_id'=> Category::inRandomOrder()->value('id') ,
            ]);

        //  Create Confirmed Bookings

            $bookings = [
                [
                    'user_id' => $users[0]->id,
                    'seats' => 3,
                ],
                [
                    'user_id' => $users[1]->id,
                    'seats' => 2,
                ],
            ];

            foreach ($bookings as $data) {
                $booking = Booking::create([
                    'user_id' => $data['user_id'],
                    'trip_id' => $trip->id,
                    'seats' => $data['seats'],
                    'total_price' => $data['seats'] * $trip->price,
                    'status' => 'confirmed',
                    'booked_at' => fake()->dateTimeBetween($trip->created_at,$trip->start_date),
                ]);

                // Update available seats

                $trip->decrement(
                    'available_seats',
                    $data['seats']
                );

                // Create companions (seats - 1)

                for ($i = 0; $i < $data['seats'] - 1; $i++) {
                    Companion::create([
                        'booking_id' => $booking->id,
                        'birth_date' => fake()->date(),
                        'name' => fake()->name(),
                        'national_id' => fake()->unique()->randomNumber(9),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        });
    }
}
