<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('main_salary_employee_addtions', function (Blueprint $table) {

            $table->foreignId('employee_id')->references('id')->on('employees')->onDelete('cascade')->after('employees_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('main_salary_employee_addition', function (Blueprint $table) {
            //
        });
    }
};
