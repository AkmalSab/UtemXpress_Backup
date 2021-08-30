<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Staff;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Staff = [
            [
                'staff_email' => 'mashanum@utem.edu.my',
                'staff_nric' => '960801065478',
                'staff_name' => 'TS. MASHANUM BINTI OSMAN',
                'staff_designation' => 'PENSYARAH KANAN',
                'staff_faculty' => 'FAKULTI TEKNOLOGI MAKLUMAT DAN KOMUNIKASI',
                'staff_division' => 'KEJURUTERAAN PERISIAN',
                'staff_status' => 'AVAILABLE',
                'created_at' => '2021-04-10 22:36:43',
                'updated_at' => '2021-04-10 22:36:43',
            ],
            [
                'staff_email' => 'satrya@utem.edu.my',
                'staff_nric' => '960845065478',
                'staff_name' => 'DR. SATRYA FAJRI PRATAMA',
                'staff_designation' => 'PENYELARAS',
                'staff_faculty' => 'FAKULTI TEKNOLOGI MAKLUMAT DAN KOMUNIKASI',
                'staff_division' => 'KEJURUTERAAN PERISIAN',
                'staff_status' => 'AVAILABLE',
                'created_at' => '2021-04-10 22:36:43',
                'updated_at' => '2021-04-10 22:36:43',
            ],
            [
                'staff_email' => 'hidayah@utem.edu.my',
                'staff_nric' => '960401065478',
                'staff_name' => 'TS. HIDAYAH BINTI RAHMALAN',
                'staff_designation' => 'PENSYARAH KANAN',
                'staff_faculty' => 'FAKULTI TEKNOLOGI MAKLUMAT DAN KOMUNIKASI',
                'staff_division' => 'KEJURUTERAAN PERISIAN',
                'staff_status' => 'AVAILABLE',
                'created_at' => '2021-04-10 22:36:43',
                'updated_at' => '2021-04-10 22:36:43',
            ]
        ];

        DB::table('staffs')->insert($Staff);
    }
}
