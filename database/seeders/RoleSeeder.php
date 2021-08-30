<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Role = [
            [
                'role_name' => 'Student (Customer)',
                'created_at' => '2021-04-10 22:36:43',
                'updated_at' => '2021-04-10 22:36:43',
            ],
            [
                'role_name' => 'Staff (Customer)',
                'created_at' => '2021-04-10 22:36:43',
                'updated_at' => '2021-04-10 22:36:43',
            ],
            [
                'role_name' => 'Student (Runner)',
                'created_at' => '2021-04-10 22:36:43',
                'updated_at' => '2021-04-10 22:36:43',
            ]
        ];

        DB::table('roles')->insert($Role);
    }
}
