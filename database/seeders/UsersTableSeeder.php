<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'username' => 'administrator',
                'email' => 'admin@dost.com',
                'email_verified_at' => '2021-10-08 14:05:21',
                'password' => '$2y$10$mlTJLlY.prOZHKl2JOP1S.eO5d..7fJnC5fdXzuoLhmmzGoa7./hO',
                'avatar' => 'avatar.jpg',
                'type' => 'Administrator',
                'status' => 'Active',
                'welcome_valid_until' => NULL,
                'remember_token' => NULL,
                'created_at' => '2021-10-08 14:05:21',
                'updated_at' => '2021-10-08 14:05:21',
            ),
            1 => 
            array (
                'id' => 2,
                'username' => 'maw0302',
                'email' => 'onE@yahoo.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$x1s66gwi/fvdzoSM3AoChOt5pA4CiMOIeuUNIdWfexIf9yYXMj7QO',
                'avatar' => 'wee-2.png',
                'type' => 'Member',
                'status' => 'Inactive',
                'welcome_valid_until' => NULL,
                'remember_token' => NULL,
                'created_at' => '2021-10-08 14:19:31',
                'updated_at' => '2021-10-08 14:19:31',
            ),
            2 => 
            array (
                'id' => 3,
                'username' => 'rss1204',
                'email' => 'two@yahoo.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$P2WRtCHBZ.RKqnTV2W8ix.ORXl7RgP423M4cj99XnLVXDglIycmQa',
                'avatar' => 'salazar-3.png',
                'type' => 'Member',
                'status' => 'Inactive',
                'welcome_valid_until' => NULL,
                'remember_token' => NULL,
                'created_at' => '2021-10-08 14:20:43',
                'updated_at' => '2021-10-08 14:20:43',
            ),
            3 => 
            array (
                'id' => 4,
                'username' => 'rbg0110',
                'email' => 'three@yahoo.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$6p7/ox8Ukbon3hGCfr.vVOGYEWWgQb8ZQPOFON64p91B8Ab/xvSZK',
                'avatar' => 'gundoy-4.png',
                'type' => 'Member',
                'status' => 'Inactive',
                'welcome_valid_until' => NULL,
                'remember_token' => NULL,
                'created_at' => '2021-10-08 14:22:21',
                'updated_at' => '2021-10-08 14:22:21',
            ),
            4 => 
            array (
                'id' => 5,
                'username' => 'adm0322',
                'email' => 'aris.moratalla@ro9.dost.gov.ph',
                'email_verified_at' => NULL,
                'password' => '$2y$10$L.bMh8QwLhs6mq0V37GzDuE6FJ2NAiJmMCla0r5ntQWicrEM1C2Ti',
                'avatar' => 'moratalla-5.png',
                'type' => 'Member',
                'status' => 'Inactive',
                'welcome_valid_until' => NULL,
                'remember_token' => NULL,
                'created_at' => '2021-10-08 14:24:19',
                'updated_at' => '2021-10-08 14:24:19',
            ),
            5 => 
            array (
                'id' => 6,
                'username' => 'gra0506',
                'email' => 'ghio.angeles@dost.gov.ph',
                'email_verified_at' => NULL,
                'password' => '$2y$10$JO/9D2xrVjX9IgWvPaktcu2DBZDUjljshtObSFLv3RftWsjb/5tO.',
                'avatar' => 'angeles-6.png',
                'type' => 'Member',
                'status' => 'Inactive',
                'welcome_valid_until' => NULL,
                'remember_token' => NULL,
                'created_at' => '2021-10-08 14:25:53',
                'updated_at' => '2021-10-08 14:25:53',
            ),
            6 => 
            array (
                'id' => 7,
                'username' => 'rja0624',
                'email' => 'ricardo.apolinario@ro9.dost.gov.ph',
                'email_verified_at' => NULL,
                'password' => '$2y$10$LKti1PhjQ2z6Yauqgs5ZgOqDRPCiBeIuPSFrV15eNza0UvsO6wU6G',
                'avatar' => 'apolinario-7.png',
                'type' => 'Member',
                'status' => 'Inactive',
                'welcome_valid_until' => NULL,
                'remember_token' => NULL,
                'created_at' => '2021-10-08 14:28:00',
                'updated_at' => '2021-10-08 14:28:00',
            ),
            7 => 
            array (
                'id' => 8,
                'username' => 'apl0321',
                'email' => 'for@yahoo.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$fc7ctF944yQB4oINwgUhPec0TfNLlekt.wZQClQJyhFa0HGH6ye7q',
                'avatar' => 'avatar.jpg',
                'type' => 'Member',
                'status' => 'Inactive',
                'welcome_valid_until' => NULL,
                'remember_token' => NULL,
                'created_at' => '2021-10-08 14:31:35',
                'updated_at' => '2021-10-08 14:31:35',
            ),
            8 => 
            array (
                'id' => 9,
                'username' => 'rij0311',
                'email' => 'kradjumli@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$VOgOHJjKrx05aK4bvsMb4.SLU39iXc3rDXCPgLa/3hRbyxQL/07ki',
                'avatar' => 'jumli-9.png',
                'type' => 'Member',
                'status' => 'Inactive',
                'welcome_valid_until' => NULL,
                'remember_token' => NULL,
                'created_at' => '2021-10-08 14:35:17',
                'updated_at' => '2021-10-08 14:35:17',
            ),
        ));
        
        
    }
}