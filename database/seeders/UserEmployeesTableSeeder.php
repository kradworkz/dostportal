<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserEmployeesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_employees')->delete();
        
        \DB::table('user_employees')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'position_id' => 70,
                'department_id' => 2,
                'status_id' => 5,
                'created_at' => '2021-10-08 14:19:31',
                'updated_at' => '2021-10-08 14:19:31',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 3,
                'position_id' => 67,
                'department_id' => 3,
                'status_id' => 5,
                'created_at' => '2021-10-08 14:20:43',
                'updated_at' => '2021-10-08 14:20:43',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 4,
                'position_id' => 58,
                'department_id' => 3,
                'status_id' => 5,
                'created_at' => '2021-10-08 14:22:21',
                'updated_at' => '2021-10-08 14:22:21',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 5,
                'position_id' => 49,
                'department_id' => 3,
                'status_id' => 5,
                'created_at' => '2021-10-08 14:24:19',
                'updated_at' => '2021-10-08 14:24:19',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 6,
                'position_id' => 18,
                'department_id' => 2,
                'status_id' => 6,
                'created_at' => '2021-10-08 14:25:53',
                'updated_at' => '2021-10-08 14:25:53',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 7,
                'position_id' => 49,
                'department_id' => 4,
                'status_id' => 5,
                'created_at' => '2021-10-08 14:28:00',
                'updated_at' => '2021-10-08 14:28:00',
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 8,
                'position_id' => 10,
                'department_id' => 3,
                'status_id' => 6,
                'created_at' => '2021-10-08 14:31:35',
                'updated_at' => '2021-10-08 14:31:35',
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 9,
                'position_id' => 38,
                'department_id' => 3,
                'status_id' => 6,
                'created_at' => '2021-10-08 14:35:17',
                'updated_at' => '2021-10-08 14:35:17',
            ),
        ));
        
        
    }
}