<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            Admin::class,
            month::class,
            Nationalitytableseeder::class,
            religionstableseeder::class,
            CountrySeeder::class,
            governoratestableseeder::class,
           citiestableseeder::class,
            blood_groups_seeder::class,
            BranchesSeeder::class,
            DepartmentsSeeder::class,
            JobTypesSeeder::class,
            OccasionsSeeder::class,
            QualificationsSeeder::class,
            ResignationTypesSeeder::class,
            shiftsSeeder::class,
            driving_Licensetableseeder::class ,



        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
