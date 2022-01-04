<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ListGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('list_groups')->delete();
        
        \DB::table('list_groups')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'regional office',
                'acronym' => 'ro-ix',
                'type' => 'Regional Office',
                'address' => 'n/a',
                'created_at' => '2021-10-11 09:40:53',
                'updated_at' => '2021-10-11 09:40:53',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'zamboanga del norte',
                'acronym' => 'pstc-zdn',
                'type' => 'Provincial S&T Center',
                'address' => 'n/a',
                'created_at' => '2021-10-11 09:41:04',
                'updated_at' => '2021-10-11 09:41:04',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'zamboanga del sur',
                'acronym' => 'pstc-zds',
                'type' => 'Provincial S&T Center',
                'address' => 'n/a',
                'created_at' => '2021-10-11 09:41:14',
                'updated_at' => '2021-10-11 09:41:14',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Zamboanga Sibugay Province',
                'acronym' => 'PSTC-ZSP',
                'type' => 'Provincial S&T Center',
                'address' => 'n/a',
                'created_at' => '2021-10-11 09:41:38',
                'updated_at' => '2021-10-11 10:05:33',
            ),
        ));
        
        
    }
}