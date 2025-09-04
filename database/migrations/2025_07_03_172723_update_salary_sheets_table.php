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
        Schema::table('salary_sheets', function (Blueprint $table) {
            $table->string('employee_name')->after('employee_id');
            $table->decimal('daily_rate', 10, 2)->after('employees_code');
            $table->integer('total_days')->after('daily_rate');
            $table->decimal('total_salary', 10, 2)->after('total_days');

            $table->dropColumn(['allowances', 'deductions', 'net_salary']); // إذا كانت موجودة
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
