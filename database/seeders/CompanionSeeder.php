<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companions')->insert([
            ['name' => 'John Doe', 'national_id' => '123456789', 'birth_date' => '1990-01-01', 'booking_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jane Smith', 'national_id' => '987654321', 'birth_date' => '1992-02-02', 'booking_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
