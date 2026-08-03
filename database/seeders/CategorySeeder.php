<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
     Category::insert([
            [
                'name' => 'Adventure',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cultural',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Beach',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mountain',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Family',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
}
}
