<?php

namespace Database\Seeders;

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
    $dest = \App\Models\Destination::first();
    $cat = \App\Models\Category::first();

    if ($dest && $cat) {
        DB::table('trips')->insert([
            'name' => 'رحلة باريس',
            'title' => 'رحلة استكشاف باريس',
            'description' => 'زيارة برج إيفل ومتحف اللوفر',
            'departure_point' => json_encode(['المطار', 'المدينة القديمة']),
            'start_date' => now()->addDays(10),
            'end_date' => now()->addDays(20),
            'booking_cancel_deadline' => now()->addDays(5),
            'total_seats' => 20,
            'available_seats' => 20,
            'price' => 1500.00,
            'status' => 'active',
            'destination_id' => $dest->id,
            'category_id' => $cat->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
}
