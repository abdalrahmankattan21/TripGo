<?php

namespace Database\Seeders;

use App\Models\Companion;
use App\Models\Trip;
use App\Models\User;
use App\Models\WaitingList;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WaitingListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $waitingCount = 7;
        $created = 0;

        while ($created < $waitingCount) {

            // select full trip
            $trip = Trip::where('available_seats', 0)
                ->inRandomOrder()
                ->first();

            $user = User::whereNotIn('id', WaitingList::pluck('user_id'))
            ->inRandomOrder()->first();
            if (!$trip || !$user) {
                break;
            }

            $seats = rand(1, 5);

            DB::transaction(function () use ($trip, $user, $seats
            ) {


                // Calculate position priority
                $position = WaitingList::where(
                    'trip_id',
                    $trip->id
                )->count() + 1;

                $waitingList = WaitingList::create([
                    'user_id' => $user->id,
                    'trip_id' => $trip->id,
                    'seats_requested' => $seats,
                    'position' => $position,
                    'status' => 'waiting',
                ]);

                // create Companions (requested-seats - 1)
                for ($i = 0; $i < $seats - 1; $i++) {
                    Companion::create([
                        'name' => fake()->name(),
                        'national_id' => fake()->unique()->randomNumber(9),
                        'waiting_list_id' => $waitingList->id,
                    ]);
                }
            });

            $created++;
        }
    }
}
