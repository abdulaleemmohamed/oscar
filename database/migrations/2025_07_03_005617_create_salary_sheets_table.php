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
        Schema::create('salary_sheets', function (Blueprint $table) {
            $table->id();
            $table->string('employees_code')->unique();
            $table->foreignId('employee_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('finance_year');
            $table->integer('month_id');
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('allowances', 10, 2)->default(0);
            $table->decimal('deductions', 10, 2)->default(0);
            $table->decimal('net_salary', 10, 2);
            $table->enum('status', ['draft', 'approved'])->default('draft');
            $table->unsignedBigInteger('com_code');
            $table->foreignId('added_by')->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('updated_by')->nullable()->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('level', ['employee', 'executive'])->default('employee');
            $table->unique(['employee_id', 'finance_year', 'month_id', 'com_code']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_sheets');
    }
};
