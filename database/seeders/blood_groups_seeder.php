<?php

namespace Database\Seeders;

use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class blood_groups_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types=['A+','A-','B+','B-','O+','O-','AB+','AB-'];
        $data = [];
        foreach ($types as $type) {
            $data[] = [
                'name'       => $type,
                'com_code'   => 1, // غيّر حسب الشركة لو عندك نظام multi-tenant
                'added_by'   => Auth::check() ? Auth::id() : 1, // fallback لو بتشغل seeder من CLI
                'active'  => 1,
                'created_at' => Carbon::now(),
            ];
        }

        // إدخال البيانات
        DB::table('blood_groups')->insert($data);
    }
}
