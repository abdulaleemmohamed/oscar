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
        Schema::create('main_salary_employee_discounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('main_salary_employee_id')
                ->references('id')->on('salary_sheets')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreignId('finance_cln_period_id')
                ->references('id')->on('finance_cln_periods')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->integer('is_auto')
                ->default(0)
                ->comment('هل تم اضافته من النظام أم بشكل يدوي');

            $table->string('employees_code');

            $table->decimal('emp_day_price', 10, 2)
                ->comment('أجر يوم الموظف');

            $table->foreignId('deduction_types_id')
                ->references('id')->on('salary_deductions')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->decimal('total', 10, 2)
                ->comment(' اجمالي الخصومات');

            $table->integer('is_archived')
                ->default(0)
                ->comment('حالة الأرشفة');

            $table->foreignId('archived_by')
                ->nullable()
                ->references('id')->on('admins')
                ->onUpdate('cascade');

            $table->dateTime('archived_at')->nullable();

            $table->string('notes', 100)->nullable();

            $table->foreignId('added_by')
                ->references('id')->on('admins')
                ->onUpdate('cascade');

            $table->foreignId('updated_by')
                ->nullable()
                ->references('id')->on('admins')
                ->onUpdate('cascade');

            $table->integer('active')->default(1);
            $table->integer('com_code');
            $table->integer('is_approved')->default(0);
            $table->dateTime('Approved_at')->nullable();
            $table->foreignId('Approved_by')->nullable()->references('id')->on('admins')->onDelete('cascade');
            $table->foreignId('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_salary_employee_discounts');
    }
};
