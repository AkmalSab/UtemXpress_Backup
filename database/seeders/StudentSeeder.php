<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Student = [
            [
                'student_email' => 'b031920030@student.utem.edu.my',
                'student_nric' => '990811145445',
                'student_name' => 'MUHAMMAD AKMAL BIN MOHD SABRI',
                'student_faculty' => 'FAKULTI TEKNOLOGI MAKLUMAT DAN KOMUNIKASI',
                'student_status' => 'AVAILABLE',
                'created_at' => '2021-04-10 22:36:43',
                'updated_at' => '2021-04-10 22:36:43',
            ],
            [
                'student_email' => 'b031920032@student.utem.edu.my',
                'student_nric' => '990821145447',
                'student_name' => 'WAN MUHAMMAD ISMAT BIN WAN AZMY',
                'student_faculty' => 'FAKULTI TEKNOLOGI MAKLUMAT DAN KOMUNIKASI',
                'student_status' => 'AVAILABLE',
                'created_at' => '2021-04-10 22:36:43',
                'updated_at' => '2021-04-10 22:36:43',
            ],
            [
                'student_email' => 'b031920017@student.utem.edu.my',
                'student_nric' => '990424065447',
                'student_name' => 'MUHAMMAD AKMAL KHAIRI BIN ABDUL HALIM',
                'student_faculty' => 'FAKULTI TEKNOLOGI MAKLUMAT DAN KOMUNIKASI',
                'student_status' => 'AVAILABLE',
                'created_at' => '2021-04-10 22:36:43',
                'updated_at' => '2021-04-10 22:36:43',
            ],
            [
                'student_email' => 'b031920020@student.utem.edu.my',
                'student_nric' => '990478065447',
                'student_name' => 'MUHAMMAD IMRAN BIN ISMAIL',
                'student_faculty' => 'FAKULTI TEKNOLOGI MAKLUMAT DAN KOMUNIKASI',
                'student_status' => 'AVAILABLE',
                'created_at' => '2021-04-10 22:36:43',
                'updated_at' => '2021-04-10 22:36:43',
            ],
            [
                'student_email' => 'b031920001@student.utem.edu.my',
                'student_nric' => '990811145478',
                'student_name' => 'DINESH A/L KUMAR',
                'student_faculty' => 'FAKULTI TEKNOLOGI MAKLUMAT DAN KOMUNIKASI',
                'student_status' => 'AVAILABLE',
                'created_at' => '2021-04-10 22:36:43',
                'updated_at' => '2021-04-10 22:36:43',
            ],
            [
                'student_email' => 'b031920042@student.utem.edu.my',
                'student_nric' => '990145051147',
                'student_name' => 'AHMAD ADI IMAN BIN ZURAIDI',
                'student_faculty' => 'FAKULTI TEKNOLOGI MAKLUMAT DAN KOMUNIKASI',
                'student_status' => 'AVAILABLE',
                'created_at' => '2021-04-10 22:36:43',
                'updated_at' => '2021-04-10 22:36:43',
            ]
        ];

        DB::table('students')->insert($Student);
    }
}
