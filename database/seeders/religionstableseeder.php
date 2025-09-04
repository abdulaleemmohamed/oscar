<?php

namespace Database\Seeders;

use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class religionstableseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // حذف الموجود قبل الإدخال
        DB::table('religions')->delete();

        // الديانات
        $religions = [
            'الإسلام',
            'المسيحية',
            'اليهودية',
            'الهندوسية',
            'البوذية',
            'السيخية',
            'الطاوية',
            'الكونفوشيوسية',
            'الزرادشتية',
            'اليانية',
            'الشنتوية',
            'البهائية',
            'الروحانية الحديثة',
            'الإلحاد',
            'اللادينية',
            'الربوبية',
            'الإحيائية (الأنيميزم)',
            'المورمونية',
            'الراستافارية',
            'الديانات الأفريقية التقليدية',
            'الديانات الأمريكية الأصلية',
            'الويكا',
        ];

        // تجهيز البيانات للإدخال
        $data = [];
        foreach ($religions as $religion) {
            $data[] = [
                'name'       => $religion,
                'com_code'   => 1, // غيّر حسب الشركة لو عندك نظام multi-tenant
                'added_by'   => Auth::check() ? Auth::id() : 1, // fallback لو بتشغل seeder من CLI
                'active'  => 1,
                'created_at' => Carbon::now(),
            ];
        }

        // إدخال البيانات
        DB::table('religions')->insert($data);
    }
}


