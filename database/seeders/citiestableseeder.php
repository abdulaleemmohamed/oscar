<?php

namespace Database\Seeders;

use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class citiestableseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['name' => 'مدينة نصر', 'governorate_id' => 1],
            ['name' => 'حلوان', 'governorate_id' => 1],
            ['name' => 'الهرم', 'governorate_id' => 2],
            ['name' => '6 أكتوبر', 'governorate_id' => 2],
            ['name' => 'العجمي', 'governorate_id' => 3],
            ['name' => 'سيدي جابر', 'governorate_id' => 3],
            ['name' => 'بلبيس', 'governorate_id' => 4],
            ['name' => 'الزقازيق', 'governorate_id' => 4],
            ['name' => 'المنصورة', 'governorate_id' => 5],
            ['name' => 'طلخا', 'governorate_id' => 5],
            ['name' => 'شبين الكوم', 'governorate_id' => 6],
            ['name' => 'السادات', 'governorate_id' => 6],
            ['name' => 'بنها', 'governorate_id' => 7],
            ['name' => 'قليوب', 'governorate_id' => 7],
            ['name' => 'طنطا', 'governorate_id' => 8],
            ['name' => 'المحلة الكبرى', 'governorate_id' => 8],
            ['name' => 'الفيوم الجديدة', 'governorate_id' => 9],
            ['name' => 'سنورس', 'governorate_id' => 9],
            ['name' => 'كفر الشيخ', 'governorate_id' => 10],
            ['name' => 'بيلا', 'governorate_id' => 10],
            ['name' => 'المنيا', 'governorate_id' => 11],
            ['name' => 'ملوي', 'governorate_id' => 11],
            ['name' => 'أسيوط', 'governorate_id' => 12],
            ['name' => 'ديروط', 'governorate_id' => 12],
            ['name' => 'سوهاج', 'governorate_id' => 13],
            ['name' => 'جرجا', 'governorate_id' => 13],
            ['name' => 'قنا', 'governorate_id' => 14],
            ['name' => 'نجع حمادي', 'governorate_id' => 14],
            ['name' => 'الأقصر', 'governorate_id' => 15],
            ['name' => 'الزينية', 'governorate_id' => 15],
            ['name' => 'أسوان', 'governorate_id' => 16],
            ['name' => 'دراو', 'governorate_id' => 16],
        ];

        foreach ($cities as $city) {
            DB::table('cities')->insert([
                'name' => $city['name'],
                'governorate_id' => $city['governorate_id'],
                'com_code' => 1,
                'is_active' => 1,
                'added_by' => Auth::check() ?Auth::id():1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
