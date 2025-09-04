<?php

namespace Database\Seeders;

use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShiftsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shifts = [
            [
                'shift_type' => 1, // صباحي
                'start_time' => '08:00:00',
                'end_time' => '16:00:00',
                'com_code' => 1,
                'active' => 1,
                'added_by' =>  Auth::check() ? Auth::id() : 1
            ],
            [
                'shift_type' => 2, // مسائي
                'start_time' => '16:00:00',
                'end_time' => '00:00:00',
                'com_code' => 1,
                'active' => 1,
                'added_by' =>  Auth::check() ? Auth::id() : 1
            ]
        ];

        // نحسب work_hours تلقائيًا
        foreach ($shifts as &$shift) {
            $start = Carbon::createFromFormat('H:i:s', $shift['start_time']);
            $end = Carbon::createFromFormat('H:i:s', $shift['end_time']);

            // لو نهاية الشفت بعد منتصف الليل
            if ($end->lessThanOrEqualTo($start)) {
                $end->addDay();
            }

            $shift['work_hours'] = $end->diffInMinutes($start) / 60;
        }

        DB::table('work_shifts')->insert($shifts);
    }

}
