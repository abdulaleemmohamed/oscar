<?php

namespace Database\Seeders;

use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class driving_Licensetableseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $licenseTypes = [
            'رخصة قيادة خاصة',
            'رخصة قيادة درجة أولى',
            'رخصة قيادة درجة ثانية',
            'رخصة قيادة درجة ثالثة',
            'رخصة قيادة دراجة نارية',
            'رخصة قيادة معدات ثقيلة',
            'رخصة قيادة دولية',
        ];

        $data = [];

        foreach ($licenseTypes as $licenseType) {
            $data[] = [
                'name' => $licenseType,
                'active' => 1,
                'com_code' => 1, // غيّر حسب النظام عندك
                'added_by' => Auth::check() ? Auth::id() : 1,
                'created_at' => Carbon::now(),
            ];
        }

        DB::table('driving__licenses')->insert($data);
    }
}
