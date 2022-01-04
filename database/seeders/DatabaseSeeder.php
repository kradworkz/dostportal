<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \DB::table('users')->insert([
        //     'username' => 'administrator',
        //     'email' => 'admin@dost.com',
        //     'password' => bcrypt('dost9ict'),
        //     'type' => 'Administrator',
        //     'status' => 'Active',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        //     'email_verified_at' => now(),
        // ]);

        // \DB::table('user_profiles')->insert([
        //     'firstname' => 'Dost',
        //     'lastname' => 'Ict',
        //     'middlename' => 'IX',
        //     'gender' => 'Male',
        //     'birthday' => '1994-03-11',
        //     'mobile_no' => '09123456789',
        //     'user_id' => 1,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // \DB::table('dropdowns')->insert([
        //     'id' => 1,
        //     'name' => 'none',
        //     'type' => 'none',
        //     'classification' => 'none',
        //     'color' => 'none',
        //     'others' => 'none',
        // ]);

        $this->call(LocationRegionsTableSeeder::class);
        $this->call(LocationProvincesTableSeeder::class);
        $this->call(LocationMunicipalitiesTableSeeder::class);
        $this->call(LocationBarangaysTableSeeder::class);
        $this->call(DropdownsTableSeeder::class);
        $this->call(PositionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UserProfilesTableSeeder::class);
        $this->call(UserEmployeesTableSeeder::class);
        $this->call(ListGroupsTableSeeder::class);
        $this->call(ListRolesTableSeeder::class);
    }
}
