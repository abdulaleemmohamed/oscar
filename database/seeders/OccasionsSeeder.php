<?php

namespace Database\Seeders;

use Auth;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OccasionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'name' => 'رأس السنة الميلادية',
                'from_date' => '2025-01-01',
                'to_date' => '2025-01-01',
                'days_counter' => 1,
                'active' => 1,
                'com_code'=>1,
                'added_by' =>  Auth::check() ? Auth::id() : 1,
            ],
            [
                'name' => 'عيد الميلاد المجيد (الشرقي)',
                'from_date' => '2025-01-07',
                'to_date' => '2025-01-07',
                'days_counter' => 1,
                'active' => true,
                'com_code'=>1,
                'added_by' =>  Auth::check() ? Auth::id() : 1,
            ],
            [
                'name' => 'عيد الحب',
                'from_date' => '2025-02-14',
                'to_date' => '2025-02-14',
                'days_counter' => 1,
                'active' => 1,
                'com_code'=>1,
                'added_by' =>  Auth::check() ? Auth::id() : 1,
            ],
            [
                'name' => 'عيد الأم',
                'from_date' => '2025-03-21',
                'to_date' => '2025-03-21',
                'days_counter' => 1,
                'active' => 1,
                'com_code'=>1,
                'added_by' =>  Auth::check() ? Auth::id() : 1,
            ],
            [
                'name' => 'عيد الفطر (تقديري)',
                'from_date' => '2025-03-31',
                'to_date' => '2025-04-02',
                'days_counter' => 3,
                'active' => 1,
                'com_code'=>1,
                'added_by' =>  Auth::check() ? Auth::id() : 1,
            ],
            [
                'name' => 'عيد الأضحى (تقديري)',
                'from_date' => '2025-06-05',
                'to_date' => '2025-06-09',
                'days_counter' => 5,
                'active' => 1,
                'com_code'=>1,
                'added_by' =>  Auth::check() ? Auth::id() : 1,
            ],
            [
                'name' => 'عيد العمال',
                'from_date' => '2025-05-01',
                'to_date' => '2025-05-01',
                'days_counter' => 1,
                'active' => 1,
                'com_code'=>1,
                'added_by' =>  Auth::check() ? Auth::id() : 1,
            ],
            [
                'name' => 'عيد الميلاد المجيد (الغربي)',
                'from_date' => '2025-12-25',
                'to_date' => '2025-12-25',
                'days_counter' => 1,
                'active' => 1,
                'com_code'=>1,
                'added_by' =>  Auth::check() ? Auth::id() : 1,
            ],
            [
                'name' => 'ليلة رأس السنة',
                'from_date' => '2025-12-31',
                'to_date' => '2025-12-31',
                'days_counter' => 1,
                'active' => 1,
                'com_code'=>1,
                'added_by' =>  Auth::check() ? Auth::id() : 1,
            ],
        ];

        DB::table('occasions')->insert($events);
    }

}
