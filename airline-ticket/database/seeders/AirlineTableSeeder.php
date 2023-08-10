<?php

namespace Database\Seeders;

use App\Models\Airline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AirlineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $airlines = [
            ['name' => 'Bamboo Airline'],
            ['name' => 'Vietnam Airline' ],
            ['name' => 'JetStart' ],
           
            // Add more airline data as needed
        ];

        foreach ($airlines as $airline) {
            Airline::create($airline);
        }
    }
}
