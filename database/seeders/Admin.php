<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new \App\Models\Admin();
        $admin->username = 'admin';
        $admin->name='ادمن افتراضي';
        $admin->email = 'admin1@yahoo.com';
        $admin->password = Hash::make('password');
        $admin->com_code= 1;
        $admin->save();
    }
}
