<?php

namespace Database\Seeders;

use Auth;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QualificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $qualifications = [
            [
                'name' => 'بكالوريوس',
                'com_code' => 1,
                'active' => true,
                'added_by' => Auth::check() ? Auth::id() : 1,
            ],
            [
                'name' => 'ماجستير',
                'com_code' => 1,
                'active' => true,
                'added_by' =>Auth::check() ? Auth::id() : 1,
            ],
            [
                'name' => 'دكتوراه',
                'com_code' => 1,
                'active' => true,
                'added_by' => Auth::check() ? Auth::id() : 1,
            ],
            [
                'name' => 'دبلومة',
                'com_code' => 1,
                'active' => false,
                'added_by' => Auth::check() ? Auth::id() : 1,
            ],
            [
                'name' => 'ثانوي عام',
                'com_code' => 1,
                'active' => true,
                'added_by' => Auth::check() ? Auth::id() : 1,
            ]
        ];

        DB::table('qualifications')->insert($qualifications);
    }
}
