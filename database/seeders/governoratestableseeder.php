<?php

namespace Database\Seeders;

use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class governoratestableseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('governorates')->delete();

        $egyptId = DB::table('countries')->where('name', 'مصر')->value('id');

        if (!$egyptId) {
            echo "❌ الدولة 'مصر' مش موجودة في جدول countries!\n";
            return;
        }

        $governorates = [
            "القاهرة", "الجيزة", "الإسكندرية", "الشرقية", "الدقهلية",
            "المنوفية", "القليوبية", "الغربية", "الفيوم", "كفر الشيخ",
            "المنيا", "أسيوط", "سوهاج", "قنا", "الأقصر", "أسوان",
            "الوادي الجديد", "البحيرة", "دمياط", "بورسعيد", "الإسماعيلية",
            "السويس", "شمال سيناء", "جنوب سيناء", "مطروح", "البحر الأحمر"
        ];

        foreach ($governorates as $name) {
            DB::table('governorates')->insert([
                'name' => $name,
                'country_id' => $egyptId,             // مرتبط بمصر
                'com_code' => 1,
                'is_active' => 1,
                'added_by' =>Auth::check()? Auth::id() :1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }

}
