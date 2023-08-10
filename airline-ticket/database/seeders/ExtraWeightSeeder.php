<?php

namespace Database\Seeders;

use App\Models\ExtraWeightFee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExtraWeightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $extraWeights = [
            ['category' => 'Over 10kg', 'amount' => '10kg' ],
            ['category' => 'Over 20kg', 'amount' => '20kg' ],
            
        ];

        foreach ($extraWeights as $extraWeight) {
            ExtraWeightFee::create($extraWeight);
        }
    }
}
