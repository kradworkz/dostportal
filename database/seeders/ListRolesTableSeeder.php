<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ListRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('list_roles')->delete();
        
        \DB::table('list_roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'regional Director',
                'definition' => 'n/a',
                'created_at' => '2021-10-11 10:15:18',
                'updated_at' => '2021-10-11 10:15:18',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'assistant regional director',
                'definition' => 'n/a',
                'created_at' => '2021-10-11 10:16:27',
                'updated_at' => '2021-10-11 10:16:27',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'document staff',
                'definition' => 'n/a',
                'created_at' => '2021-10-11 10:16:31',
                'updated_at' => '2021-10-11 10:16:31',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'travel staff',
                'definition' => 'n/a',
                'created_at' => '2021-10-11 10:16:37',
                'updated_at' => '2021-10-11 10:16:37',
            ),
        ));
        
        
    }
}