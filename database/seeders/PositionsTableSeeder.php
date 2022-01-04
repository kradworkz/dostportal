<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('list_positions')->delete();
        
        \DB::table('list_positions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'laborer i',
                'code' => 'labor i',
                'salary_id' => 7,
                'created_at' => '2021-09-28 11:26:03',
                'updated_at' => '2021-09-28 11:26:03',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'utility worker i',
                'code' => 'uw i',
                'salary_id' => 7,
                'created_at' => '2021-09-28 12:09:37',
                'updated_at' => '2021-09-28 12:09:37',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'laboratory aide i',
                'code' => 'la i',
                'salary_id' => 8,
                'created_at' => '2021-09-28 12:09:56',
                'updated_at' => '2021-09-28 12:09:56',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'clerk',
                'code' => 'clerk',
                'salary_id' => 9,
                'created_at' => '2021-09-28 12:10:07',
                'updated_at' => '2021-09-28 12:10:07',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'driver i',
                'code' => 'driver',
                'salary_id' => 9,
                'created_at' => '2021-09-28 12:10:19',
                'updated_at' => '2021-09-28 12:10:19',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'laborer iI',
                'code' => 'labor ii',
                'salary_id' => 9,
                'created_at' => '2021-09-28 12:10:41',
                'updated_at' => '2021-09-28 12:10:41',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Clerk iI',
                'code' => 'clerk ii',
                'salary_id' => 10,
                'created_at' => '2021-09-28 12:11:26',
                'updated_at' => '2021-09-28 12:11:26',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'driver II',
                'code' => 'driver ii',
                'salary_id' => 10,
                'created_at' => '2021-09-28 12:11:38',
                'updated_at' => '2021-09-28 12:11:38',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'laboratory aide ii',
                'code' => 'la ii',
                'salary_id' => 10,
                'created_at' => '2021-09-28 12:12:02',
                'updated_at' => '2021-09-28 12:12:02',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'science aide ii',
                'code' => 'sa ii',
                'salary_id' => 10,
                'created_at' => '2021-09-28 12:12:17',
                'updated_at' => '2021-09-28 12:12:17',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'agriculture technician i',
                'code' => 'at i',
                'salary_id' => 11,
                'created_at' => '2021-09-28 12:13:51',
                'updated_at' => '2021-09-28 12:13:51',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'clerk iii',
                'code' => 'clerk iii',
                'salary_id' => 11,
                'created_at' => '2021-09-28 12:14:08',
                'updated_at' => '2021-09-28 12:14:08',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'labor foreman',
                'code' => 'lf',
                'salary_id' => 11,
                'created_at' => '2021-09-28 12:14:28',
                'updated_at' => '2021-09-28 12:14:28',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'laboratory technician i',
                'code' => 'lt i',
                'salary_id' => 11,
                'created_at' => '2021-09-28 12:14:43',
                'updated_at' => '2021-09-28 12:14:43',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'utility foreman',
                'code' => 'uf',
                'salary_id' => 11,
                'created_at' => '2021-09-28 12:15:05',
                'updated_at' => '2021-09-28 12:15:05',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'computer operator i',
                'code' => 'co i',
                'salary_id' => 12,
                'created_at' => '2021-09-28 12:15:25',
                'updated_at' => '2021-09-28 12:15:25',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'agricultural technician ii',
                'code' => 'at ii',
                'salary_id' => 13,
                'created_at' => '2021-09-28 12:15:51',
                'updated_at' => '2021-09-28 12:15:51',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'clerk iv',
                'code' => 'clerk iv',
                'salary_id' => 13,
                'created_at' => '2021-09-28 12:16:10',
                'updated_at' => '2021-09-28 12:16:10',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'labor general foreman',
                'code' => 'lgf',
                'salary_id' => 13,
                'created_at' => '2021-09-28 12:16:26',
                'updated_at' => '2021-09-28 12:16:26',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'laboratory inspector i',
                'code' => 'li i',
                'salary_id' => 13,
                'created_at' => '2021-09-28 12:16:52',
                'updated_at' => '2021-09-28 12:16:52',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'laboratory technician ii',
                'code' => 'lt ii',
                'salary_id' => 13,
                'created_at' => '2021-09-28 12:17:20',
                'updated_at' => '2021-09-28 12:17:20',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'project development assistant',
                'code' => 'PDA',
                'salary_id' => 13,
                'created_at' => '2021-09-28 12:17:44',
                'updated_at' => '2021-09-28 12:17:44',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Project assistant i',
                'code' => 'pa i',
                'salary_id' => 13,
                'created_at' => '2021-09-28 12:18:05',
                'updated_at' => '2021-09-28 12:18:05',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'computer operator ii',
                'code' => 'co ii',
                'salary_id' => 14,
                'created_at' => '2021-09-28 12:19:09',
                'updated_at' => '2021-09-28 12:19:09',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'science research assistant',
                'code' => 'sra',
                'salary_id' => 14,
                'created_at' => '2021-09-28 12:19:36',
                'updated_at' => '2021-09-28 12:19:36',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'laboratory inspector ii',
                'code' => 'li ii',
                'salary_id' => 15,
                'created_at' => '2021-09-28 12:19:58',
                'updated_at' => '2021-09-28 12:19:58',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'project assistant ii',
                'code' => 'pa ii',
                'salary_id' => 15,
                'created_at' => '2021-09-28 12:20:13',
                'updated_at' => '2021-09-28 12:20:13',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'computer maintenance technologist i',
                'code' => 'cmt i',
                'salary_id' => 16,
                'created_at' => '2021-09-28 12:20:43',
                'updated_at' => '2021-09-28 12:20:43',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'computer programmer i',
                'code' => 'cp i',
                'salary_id' => 16,
                'created_at' => '2021-09-28 12:20:59',
                'updated_at' => '2021-09-28 12:20:59',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'data entry machine operator iii',
                'code' => 'demo iii',
                'salary_id' => 16,
                'created_at' => '2021-09-28 12:21:21',
                'updated_at' => '2021-09-28 12:21:21',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'information officer i',
                'code' => 'io i',
                'salary_id' => 16,
                'created_at' => '2021-09-28 12:21:38',
                'updated_at' => '2021-09-28 12:21:38',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'science research analyst',
                'code' => 'sra',
                'salary_id' => 16,
                'created_at' => '2021-09-28 12:22:01',
                'updated_at' => '2021-09-28 12:22:01',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'project evaluation officer i',
                'code' => 'peo i',
                'salary_id' => 16,
                'created_at' => '2021-09-28 12:22:15',
                'updated_at' => '2021-09-28 12:22:15',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'project development officer i',
                'code' => 'pdo i',
                'salary_id' => 16,
                'created_at' => '2021-09-28 12:22:36',
                'updated_at' => '2021-09-28 12:22:36',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'computer operator iii',
                'code' => 'co iii',
                'salary_id' => 17,
                'created_at' => '2021-09-28 12:22:57',
                'updated_at' => '2021-09-28 12:22:57',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'project assistant iii',
                'code' => 'pa iii',
                'salary_id' => 17,
                'created_at' => '2021-09-28 12:23:12',
                'updated_at' => '2021-09-28 12:23:12',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'university research associate i',
                'code' => 'ura i',
                'salary_id' => 17,
                'created_at' => '2021-09-28 12:23:38',
                'updated_at' => '2021-09-28 12:23:38',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'science research specialist i',
                'code' => 'srs i',
                'salary_id' => 18,
                'created_at' => '2021-09-28 12:23:53',
                'updated_at' => '2021-09-28 12:23:53',
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'computer operator iv',
                'code' => 'co iv',
                'salary_id' => 19,
                'created_at' => '2021-09-28 12:24:11',
                'updated_at' => '2021-09-28 12:24:11',
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'information systems researcher ii',
                'code' => 'isr ii',
                'salary_id' => 19,
                'created_at' => '2021-09-28 12:24:39',
                'updated_at' => '2021-09-28 12:24:39',
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'project assistant iv',
                'code' => 'pa iv',
                'salary_id' => 19,
                'created_at' => '2021-09-28 12:24:53',
                'updated_at' => '2021-09-28 12:24:53',
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'university research associate ii',
                'code' => 'ura ii',
                'salary_id' => 19,
                'created_at' => '2021-09-28 12:25:19',
                'updated_at' => '2021-09-28 12:25:19',
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'computer maintenance technologist ii',
                'code' => 'cmt ii',
                'salary_id' => 20,
                'created_at' => '2021-09-28 12:25:36',
                'updated_at' => '2021-09-28 12:25:36',
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'computer programmer ii',
                'code' => 'cp ii',
                'salary_id' => 20,
                'created_at' => '2021-09-28 12:26:02',
                'updated_at' => '2021-09-28 12:26:02',
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'information officer ii',
                'code' => 'io ii',
                'salary_id' => 20,
                'created_at' => '2021-09-28 12:26:30',
                'updated_at' => '2021-09-28 12:26:30',
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'project evaluation ii',
                'code' => 'pe ii',
                'salary_id' => 20,
                'created_at' => '2021-09-28 12:26:49',
                'updated_at' => '2021-09-28 12:26:49',
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'project development officer ii',
                'code' => 'pdo ii',
                'salary_id' => 20,
                'created_at' => '2021-09-28 12:27:09',
                'updated_at' => '2021-09-28 12:27:09',
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'information systems analyst ii',
                'code' => 'isa ii',
                'salary_id' => 21,
                'created_at' => '2021-09-28 12:27:30',
                'updated_at' => '2021-09-28 12:27:30',
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'science research specialist ii',
                'code' => 'srs ii',
                'salary_id' => 21,
                'created_at' => '2021-09-28 12:28:06',
                'updated_at' => '2021-09-28 12:28:06',
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'university researcher i',
                'code' => 'ur i',
                'salary_id' => 21,
                'created_at' => '2021-09-28 12:28:42',
                'updated_at' => '2021-09-28 12:28:42',
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'computer maintenance technologist iii',
                'code' => 'cmt iii',
                'salary_id' => 22,
                'created_at' => '2021-09-28 12:29:13',
                'updated_at' => '2021-09-28 12:29:13',
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'computer programmer iii',
                'code' => 'cp iii',
                'salary_id' => 23,
                'created_at' => '2021-09-28 12:29:37',
                'updated_at' => '2021-09-28 12:29:37',
            ),
            52 => 
            array (
                'id' => 53,
                'name' => 'information officer iii',
                'code' => 'io iii',
                'salary_id' => 23,
                'created_at' => '2021-09-28 12:29:51',
                'updated_at' => '2021-09-28 12:29:51',
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'project development officer iii',
                'code' => 'pdo iii',
                'salary_id' => 23,
                'created_at' => '2021-09-28 12:30:26',
                'updated_at' => '2021-09-28 12:30:26',
            ),
            54 => 
            array (
                'id' => 55,
                'name' => 'project evaluation officer iii',
                'code' => 'peo iii',
                'salary_id' => 23,
                'created_at' => '2021-09-28 12:30:54',
                'updated_at' => '2021-09-28 12:30:54',
            ),
            55 => 
            array (
                'id' => 56,
                'name' => 'university researcher ii',
                'code' => 'ur ii',
                'salary_id' => 23,
                'created_at' => '2021-09-28 12:31:12',
                'updated_at' => '2021-09-28 12:31:12',
            ),
            56 => 
            array (
                'id' => 57,
                'name' => 'information technology officer i',
                'code' => 'ito i',
                'salary_id' => 24,
                'created_at' => '2021-09-28 12:31:45',
                'updated_at' => '2021-09-28 12:31:45',
            ),
            57 => 
            array (
                'id' => 58,
                'name' => 'senior science research specialist',
                'code' => 'ssrs',
                'salary_id' => 24,
                'created_at' => '2021-09-28 12:32:06',
                'updated_at' => '2021-09-28 12:32:06',
            ),
            58 => 
            array (
                'id' => 59,
                'name' => 'project officer i',
                'code' => 'po i',
                'salary_id' => 25,
                'created_at' => '2021-09-28 12:32:19',
                'updated_at' => '2021-09-28 12:32:19',
            ),
            59 => 
            array (
                'id' => 60,
                'name' => 'university researcher iii',
                'code' => 'ur iii',
                'salary_id' => 25,
                'created_at' => '2021-09-28 12:32:39',
                'updated_at' => '2021-09-28 12:32:39',
            ),
            60 => 
            array (
                'id' => 61,
                'name' => 'project officer ii',
                'code' => 'po ii',
                'salary_id' => 26,
                'created_at' => '2021-09-28 12:33:07',
                'updated_at' => '2021-09-28 12:33:07',
            ),
            61 => 
            array (
                'id' => 62,
                'name' => 'information officer iv',
                'code' => 'io iv',
                'salary_id' => 27,
                'created_at' => '2021-09-28 12:33:23',
                'updated_at' => '2021-09-28 12:33:23',
            ),
            62 => 
            array (
                'id' => 63,
                'name' => 'information technology officer ii',
                'code' => 'ito ii',
                'salary_id' => 27,
                'created_at' => '2021-09-28 12:33:43',
                'updated_at' => '2021-09-28 12:33:43',
            ),
            63 => 
            array (
                'id' => 64,
                'name' => 'project officer iii',
                'code' => 'po iii',
                'salary_id' => 27,
                'created_at' => '2021-09-28 12:33:56',
                'updated_at' => '2021-09-28 12:33:56',
            ),
            64 => 
            array (
                'id' => 65,
                'name' => 'project evaluation officer iv',
                'code' => 'peo iv',
                'salary_id' => 27,
                'created_at' => '2021-09-28 12:34:19',
                'updated_at' => '2021-09-28 12:34:19',
            ),
            65 => 
            array (
                'id' => 66,
                'name' => 'project development officer iv',
                'code' => 'pdo iv',
                'salary_id' => 27,
                'created_at' => '2021-09-28 12:34:37',
                'updated_at' => '2021-09-28 12:34:37',
            ),
            66 => 
            array (
                'id' => 67,
                'name' => 'supervising science research specialist',
                'code' => 'sUPERsrs',
                'salary_id' => 27,
                'created_at' => '2021-09-28 12:35:14',
                'updated_at' => '2021-09-28 12:35:14',
            ),
            67 => 
            array (
                'id' => 68,
                'name' => 'university researcher iv',
                'code' => 'ur iv',
                'salary_id' => 27,
                'created_at' => '2021-09-28 12:35:35',
                'updated_at' => '2021-09-28 12:35:35',
            ),
            68 => 
            array (
                'id' => 69,
                'name' => 'project officer iv',
                'code' => 'po iv',
                'salary_id' => 28,
                'created_at' => '2021-09-28 12:36:02',
                'updated_at' => '2021-09-28 12:36:02',
            ),
            69 => 
            array (
                'id' => 70,
                'name' => 'chief science research specialist',
                'code' => 'csrs',
                'salary_id' => 29,
                'created_at' => '2021-09-28 12:36:28',
                'updated_at' => '2021-09-28 12:36:28',
            ),
            70 => 
            array (
                'id' => 71,
                'name' => 'project officer v',
                'code' => 'po v',
                'salary_id' => 29,
                'created_at' => '2021-09-28 12:36:40',
                'updated_at' => '2021-09-28 12:36:40',
            ),
            71 => 
            array (
                'id' => 72,
                'name' => 'university researcher v',
                'code' => 'ur v',
                'salary_id' => 29,
                'created_at' => '2021-09-28 12:36:54',
                'updated_at' => '2021-09-28 12:36:54',
            ),
        ));
        
        
    }
}