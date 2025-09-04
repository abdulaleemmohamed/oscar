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
        Schema::create('main_salary_employee_absences', function (Blueprint $table) {
            $table->id();
            $table->string('employees_code');
            $table->foreignId('month_salary_id')->references('id')->on('salary_sheets')->onDelete('cascade');


            $table->foreignId('finance_cln_period_id')->references('id')->on('finance_cln_periods')->onDelete('cascade');

            $table->decimal('emp_day_salary', 10, 2);
            $table->decimal('days_deducted', 4, 2);
            $table->decimal('total_value', 10, 2);
            $table->string('notes')->nullable();
            $table->integer('is_archived')->default(0);
            $table->integer('is_approved')->default(0);

            $table->unsignedBigInteger('com_code');
            // علاقات خارجية
            $table->foreignId('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreignId('added_by')->references('id')->on('admins')->onDelete('cascade');
            $table->foreignId('Approved_by')->nullable()->references('id')->on('admins')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_salary_employee_absences');
    }
};
