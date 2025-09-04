<?php

namespace Database\Seeders;

use App\Models\Nationality;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Nationalitytableseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { DB::table('nationalities')->delete();

        // قائمة الجنسيات (تقدر تضيف أو تعدل عليها)
        $nationalities = [
            'أفغاني',
            'ألباني',
            'جزائري',
            'أمريكي',
            'أندونيسي',
            'أرجنتيني',
            'بحريني',
            'بنغالي',
            'بلجيكي',
            'برازيلي',
            'كندي',
            'مصري',
            'فرنسي',
            'ألماني',
            'هندي',
            'إيراني',
            'عراقي',
            'أيرلندي',
            'إيطالي',
            'ياباني',
            'كويتي',
            'لبناني',
            'ليبي',
            'ماليزي',
            'مغربي',
            'هولندي',
            'نيجيري',
            'باكستاني',
            'فلسطيني',
            'روسي',
            'سعودي',
            'صومالي',
            'سوداني',
            'سوري',
            'تركي',
            'إماراتي',
            'بريطاني',
            'يمني',
        ];

        // تحضير البيانات للإدخال
        $data = [];
        foreach ($nationalities as $name) {
            $data[] = [
                'name'       => $name,
                'com_code'   => 1, // لو عندك شركات متعددة غيّره حسب الحاجة
                'added_by'   => Auth::check() ? Auth::id() : 1,
                'is_active'  => 1,
                'created_at' => Carbon::now(),
            ];
        }

        // إدخال البيانات
        DB::table('nationalities')->insert($data);
    }

}
