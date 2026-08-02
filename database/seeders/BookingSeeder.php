<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Companion;
use App\Models\Payment;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $confirmedBookingsCount = 7;
        $cancelledBookingsCount = 3;

        // Confirmed Bookings

        $created = 0;

        while ($created < $confirmedBookingsCount) {
            $trip = Trip::where('available_seats', '>', 0)
                ->inRandomOrder()
                ->first();

            $user = User::whereNotIn('id', Booking::pluck('user_id'))
            ->inRandomOrder()->first();;

            if (!$trip || !$user) {
                break;
            }

            // prevent the same user from booking the same trip more then once
            $alreadyBooked = Booking::where('user_id', $user->id)
                ->where('trip_id', $trip->id)
                ->exists();

            if ($alreadyBooked) {
                continue;
            }

            $seats = rand(1, 5);

            // ensure if there are available seats
            if ($trip->available_seats < $seats) {
                continue;
            }

            DB::transaction(function () use ($trip, $user, $seats
            ) {
                $booking = Booking::create([
                    'user_id' => $user->id,
                    'trip_id' => $trip->id,
                    'seats' => $seats,
                    'total_price' => $seats * $trip->price,
                    'status' => 'confirmed',
                    'booked_at' => now(),

                ]);

                $trip->decrement('available_seats', $seats);

                // Create Companions
                for ($i = 0; $i < $seats - 1; $i++) {

                    Companion::create([
                        'booking_id' => $booking->id,
                        'name' => fake()->name(),
                        'national_id' => fake()->unique()->randomNumber(9),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                }

                // Create Payment
                Payment::create([
                    'booking_id' => $booking->id,
                    'amount' => $booking->total_price,
                    'status' => 'paid',
                    ]);
            });



            $created++;
        }

    // Cancelled Bookings

        $created = 0;

        while ($created < $cancelledBookingsCount) {
            $trip = Trip::inRandomOrder()->first();
            $user = User::inRandomOrder()->first();

            if (!$trip || !$user) {
                break;
            }

            $alreadyBooked = Booking::where('user_id', $user->id)
                ->where('trip_id', $trip->id)
                ->exists();

            if ($alreadyBooked) {
                continue;
            }

            $seats = rand(1, 5);
            $bookedAt = $trip->start_date->subDays(10);
            $booking = Booking::create([
                'user_id' => $user->id,
                'trip_id' => $trip->id,
                'seats' => $seats,
                'total_price' => $seats * $trip->price,
                'status' => 'cancelled',
                'booked_at' => $bookedAt,
                'cancelled_at' => fake()->dateTimeBetween(
                $bookedAt,
                $trip->booking_cancel_deadline,
                ),
                'cancellation_reason' => fake()->paragraph(),

            ]);

            Payment::create([
                "amount" => $seats * $trip->price,
                "booking_id" => $booking->id,
                "status" => "refund"
            ]);
            $created++;
        }
    }
}
