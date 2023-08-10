<?php

namespace Database\Seeders;

use App\Models\ExtraFee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExtraFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $extraFees = [
            ['category' => 'Phụ thu dịch vụ hệ thống(Quốc nội)', 'price' => '10.00' ],
            ['category' => 'Phụ thu quản trị hệ thống', 'price' => '10.00' ],
            ['category' => 'Phí an ninh soi chiếu', 'price' => '1.00' ],
            ['category' => 'Phí sân bay quốc nội', 'price' => '5.00' ],
            // Add more airline data as needed
        ];

        foreach ($extraFees as $extraFee) {
            ExtraFee::create($extraFee);
        }
    }
}
