<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $Vehicle = [
            [
                'vehicle_type' => 'Walk / Bicycle',
                'vehicle_weight_capacity' => '3 KG',
                'vehicle_size_capacity' => '0.1 X 0.1 X 0.1',
            ],
            [
                'vehicle_type' => 'Motorcycle',
                'vehicle_weight_capacity' => '10 KG',
                'vehicle_size_capacity' => '0.3 X 0.3 X 0.3',
            ],
            [
                'vehicle_type' => 'Car',
                'vehicle_weight_capacity' => '40 KG',
                'vehicle_size_capacity' => '0.5 X 0.5 X 0.5',
            ]
        ];

        DB::table('vehicle')->insert($Vehicle);
    }
}
