<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserProfilesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_profiles')->delete();
        
        \DB::table('user_profiles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'firstname' => 'Dost',
                'lastname' => 'Ict',
                'middlename' => 'IX',
                'extension' => NULL,
                'gender' => 'Male',
                'birthday' => '1994-03-11',
                'mobile_no' => '09123456789',
                'user_id' => 1,
                'created_at' => '2021-10-08 14:06:18',
                'updated_at' => '2021-10-08 14:06:18',
            ),
            1 => 
            array (
                'id' => 2,
                'firstname' => 'martin',
                'lastname' => 'wee',
                'middlename' => 'Ausejo',
                'extension' => NULL,
                'gender' => 'Male',
                'birthday' => '1983-03-02',
                'mobile_no' => '639178590382',
                'user_id' => 2,
                'created_at' => '2021-10-08 14:19:31',
                'updated_at' => '2021-10-08 14:19:31',
            ),
            2 => 
            array (
                'id' => 3,
                'firstname' => 'rosemarie',
                'lastname' => 'salazar',
                'middlename' => 'Sinsuan',
                'extension' => NULL,
                'gender' => 'Female',
                'birthday' => '1987-12-04',
                'mobile_no' => '639177224118',
                'user_id' => 3,
                'created_at' => '2021-10-08 14:20:43',
                'updated_at' => '2021-10-08 14:20:43',
            ),
            3 => 
            array (
                'id' => 4,
                'firstname' => 'ronnel',
                'lastname' => 'gundoy',
                'middlename' => 'baluan',
                'extension' => NULL,
                'gender' => 'Male',
                'birthday' => '1991-01-10',
                'mobile_no' => '639266511082',
                'user_id' => 4,
                'created_at' => '2021-10-08 14:22:21',
                'updated_at' => '2021-10-08 14:22:21',
            ),
            4 => 
            array (
                'id' => 5,
                'firstname' => 'aris',
                'lastname' => 'moratalla',
                'middlename' => 'despalo',
                'extension' => NULL,
                'gender' => 'Male',
                'birthday' => '1990-03-22',
                'mobile_no' => '639274790425',
                'user_id' => 5,
                'created_at' => '2021-10-08 14:24:19',
                'updated_at' => '2021-10-08 14:24:19',
            ),
            5 => 
            array (
                'id' => 6,
                'firstname' => 'Ghio Edmar',
                'lastname' => 'angeles',
                'middlename' => 'rusel',
                'extension' => NULL,
                'gender' => 'Male',
                'birthday' => '1990-05-06',
                'mobile_no' => '639952819299',
                'user_id' => 6,
                'created_at' => '2021-10-08 14:25:53',
                'updated_at' => '2021-10-08 14:25:53',
            ),
            6 => 
            array (
                'id' => 7,
                'firstname' => 'Ricardo',
                'lastname' => 'apolinario',
                'middlename' => 'jaldon',
                'extension' => 'iii',
                'gender' => 'Male',
                'birthday' => '1990-06-24',
                'mobile_no' => '639278318824',
                'user_id' => 7,
                'created_at' => '2021-10-08 14:28:00',
                'updated_at' => '2021-10-08 14:28:00',
            ),
            7 => 
            array (
                'id' => 8,
                'firstname' => 'Allan Geion',
                'lastname' => 'legaspi',
                'middlename' => 'p',
                'extension' => NULL,
                'gender' => 'Male',
                'birthday' => '1990-03-21',
                'mobile_no' => '09123654789',
                'user_id' => 8,
                'created_at' => '2021-10-08 14:31:35',
                'updated_at' => '2021-10-08 14:31:35',
            ),
            8 => 
            array (
                'id' => 9,
                'firstname' => 'ra-ouf',
                'lastname' => 'jumli',
                'middlename' => 'indanan',
                'extension' => NULL,
                'gender' => 'Male',
                'birthday' => '1994-03-11',
                'mobile_no' => '09557650803',
                'user_id' => 9,
                'created_at' => '2021-10-08 14:35:17',
                'updated_at' => '2021-10-08 14:35:17',
            ),
        ));
        
        
    }
}