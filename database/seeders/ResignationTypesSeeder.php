<?php

namespace Database\Seeders;

use Auth;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResignationTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'استقالة طوعية',
                'com_code' => 1,
                'active' => 1,
                'added_by' =>  Auth::check() ? Auth::id() : 1
            ],
            [
                'name' => 'استقالة تأديبية',
                'com_code' => 1,
                'active' => 1,
                'added_by' =>  Auth::check() ? Auth::id() : 1
            ],
            [
                'name' => 'تقاعد مبكر',
                'com_code' => 1,
                'active' => 1,
                'added_by' =>  Auth::check() ? Auth::id() : 1
            ],
            [
                'name' => 'إنهاء عقد بالتراضي',
                'com_code' => 1,
                'active' => 1,
                'added_by' =>  Auth::check() ? Auth::id() : 1
            ],
            [
                'name' => 'أسباب صحية',
                'com_code' => 1,
                'active' => 1,
                'added_by' =>  Auth::check() ? Auth::id() : 1
            ]
        ];

        DB::table('resignations')->insert($types);
    }

}
