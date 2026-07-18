<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Guide;

class GuideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guide1 = Guide::create([
            'name' => 'أحمد مصطفى',
            'email' => 'VnX2A@example.com',
            'phone' => '1234567890',
            'languages' => ['العربية', 'English'],
            'status' => 'available'
        ]);

        $guide2 = Guide::create([
            'name' => 'سارة جونز',
            'email' => 'sarah.jones@example.com',
            'phone' => '0987654321',
            'languages' => ['English', 'Français'],
            'status' => 'available'
        ]);

        $guide3 = Guide::create([
            'name' => 'كارلوس سعيد',
            'email' => 'karl.os.said@example.com',
            'phone' => '1111111111',
            'languages' => ['العربية', 'Español'],
            'status' => 'busy'
        ]);

    }
}
