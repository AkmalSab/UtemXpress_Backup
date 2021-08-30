<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $AdditionalServices = [
            [
                'service_name' => 'Xpress Bag',
            ],
            [
                'service_name' => 'Buy For You',
            ],
            [
                'service_name' => 'Return Trip',
            ],
            [
                'service_name' => 'Door to Door',
            ],
        ];

        DB::table('additional_services')->insert($AdditionalServices);
    }
}
