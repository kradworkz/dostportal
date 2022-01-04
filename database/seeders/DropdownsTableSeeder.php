<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DropdownsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('dropdowns')->delete();
        
        \DB::table('dropdowns')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'none',
                'classification' => 'none',
                'type' => 'none',
                'color' => 'none',
                'others' => 'none',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Office Of The Regional Director',
                'classification' => 'Group',
                'type' => 'Department',
                'color' => 'n/a',
                'others' => 'ORD',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Finance, Administrative Support And Technical Services',
                'classification' => 'Group',
                'type' => 'Department',
                'color' => 'n/a',
                'others' => 'FASTS',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Field Operations Services',
                'classification' => 'Group',
                'type' => 'Department',
                'color' => 'n/a',
                'others' => 'FOS',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Regular Employee',
                'classification' => 'Group',
                'type' => 'Employment Status',
                'color' => 'n/a',
                'others' => 'Plantilla',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Contractual Of Service',
                'classification' => 'Group',
                'type' => 'Employment Status',
                'color' => 'n/a',
                'others' => 'Contractual',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => '1',
                'classification' => 'Salary',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => '14440.80',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => '2',
                'classification' => 'Salary',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => '15348',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => '3',
                'classification' => 'Salary',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => '16286.40',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => '4',
                'classification' => 'Salary',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => '17280',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => '6',
                'classification' => 'Salary',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => '19440',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => '7',
                'classification' => 'Salary',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => '20614.80',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => '8',
                'classification' => 'Salary',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => '21901.20',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => '9',
                'classification' => 'Salary',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => '23462.40',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => '10',
                'classification' => 'Salary',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => '25446',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => '11',
                'classification' => 'Salary',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => '28652.40',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => '12',
                'classification' => 'Salary',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => '31262.40',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => '13',
                'classification' => 'Salary',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => '33931.20',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => '14',
                'classification' => 'Salary',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => '36958.80',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => '15',
                'classification' => 'Salary',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => '40290',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => '16',
                'classification' => 'Salary',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => '43953.60',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => '17',
                'classification' => 'Salary',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => '47983.20',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => '18',
                'classification' => 'Salary',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => '52417.20',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => '19',
                'classification' => 'Salary',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => '57975.60',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => '20',
                'classification' => 'Salary',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => '65101.20',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => '21',
                'classification' => 'Salary',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => '73081.20',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => '22',
                'classification' => 'Salary',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => '82098',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => '23',
                'classification' => 'Salary',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => '92288.40',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => '24',
                'classification' => 'Salary',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => '104090.40',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Letter',
                'classification' => 'Document Type',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Announcement',
                'classification' => 'Document Type',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Notice Of Meeting',
                'classification' => 'Document Type',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Memorandum',
                'classification' => 'Document Type',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'Moa',
                'classification' => 'Document Type',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'Administrative Order',
                'classification' => 'Document Type',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'Special Order',
                'classification' => 'Document Type',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'Minutes Of Meeting',
                'classification' => 'Document Type',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'Publication',
                'classification' => 'Document Type',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'Please Rush',
                'classification' => 'Document Action',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'Please Attend',
                'classification' => 'Document Action',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'Please Draft Reply/memo/letter',
                'classification' => 'Document Action',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'Please Acknowledge Receipt',
                'classification' => 'Document Action',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'Please Discuss With Me',
                'classification' => 'Document Action',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'Please Calendar',
                'classification' => 'Document Action',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'Please Follow Up',
                'classification' => 'Document Action',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'Please Act On This',
                'classification' => 'Document Action',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'Please Post',
                'classification' => 'Document Action',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'Please Give Me Feedback',
                'classification' => 'Document Action',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'Please File',
                'classification' => 'Document Action',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'For Your Information/study/reference',
                'classification' => 'Document Action',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'For Your Comments',
                'classification' => 'Document Action',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'For Your Initials/signature',
                'classification' => 'Document Action',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            52 => 
            array (
                'id' => 53,
                'name' => 'Regional Director',
                'classification' => 'Role',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'Assistant Regional Director',
                'classification' => 'Role',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            54 => 
            array (
                'id' => 55,
                'name' => 'Document Staff',
                'classification' => 'Role',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            55 => 
            array (
                'id' => 56,
                'name' => 'Travel Staff',
                'classification' => 'Role',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            56 => 
            array (
                'id' => 57,
                'name' => 'Official Vehicle',
                'classification' => 'Travel Mode',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            57 => 
            array (
                'id' => 58,
                'name' => 'Public Conveyance',
                'classification' => 'Travel Mode',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            58 => 
            array (
                'id' => 59,
                'name' => 'Vehicle Rental',
                'classification' => 'Travel Mode',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            59 => 
            array (
                'id' => 60,
                'name' => 'Pending',
                'classification' => 'Travel Status',
                'type' => 'n/a',
                'color' => 'yellow',
                'others' => 'bxs-info-circle',
            ),
            60 => 
            array (
                'id' => 61,
                'name' => 'Approved',
                'classification' => 'Travel Status',
                'type' => 'n/a',
                'color' => 'green',
                'others' => 'bxs-badge-check',
            ),
            61 => 
            array (
                'id' => 62,
                'name' => 'Declined',
                'classification' => 'Travel Status',
                'type' => 'n/a',
                'color' => 'red',
                'others' => 'bxs-info-circle',
            ),
            62 => 
            array (
                'id' => 63,
                'name' => 'Cancelled',
                'classification' => 'Travel Status',
                'type' => 'n/a',
                'color' => 'gray',
                'others' => 'bxs-info-circle',
            ),
        ));
        
        
    }
}