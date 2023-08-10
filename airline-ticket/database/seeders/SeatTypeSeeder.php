<?php

namespace Database\Seeders;

use App\Models\SeatType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeatTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $airlines = [
            ['name' => 'Economic'],
            ['name' => 'Business'],
            // Add more airline data as needed
        ];

        foreach ($airlines as $airline) {
            SeatType::create($airline);
        }
    }
}