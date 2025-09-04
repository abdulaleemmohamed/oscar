<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class month extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =
            [
                ['name_ar'=>'يناير','name_en'=>'January'],
                ['name_ar'=>'فبراير','name_en'=>'February'],
                ['name_ar'=>'مارس','name_en'=>'March'],
                ['name_ar'=>'أبريل','name_en'=>'April'],
                ['name_ar'=>'مايو','name_en'=>'May'],
                ['name_ar'=>'يونيو','name_en'=>'June'],
                ['name_ar'=>'يوليو','name_en'=>'July'],
                ['name_ar'=>'أغسطس','name_en'=>'August'],
                ['name_ar'=>'سبتمبر','name_en'=>'September'],
                ['name_ar'=>'اكتوبر','name_en'=>'October'],
                ['name_ar'=>'نوفمبر','name_en'=>'November'],
                ['name_ar'=>'ديسمبر','name_en'=>'December'],

            ];
        foreach ($data as $d) {


            DB::table('months')->insert($d);
        }

    }
}
