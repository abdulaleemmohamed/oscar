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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employees_code')->comment('كود الموظف التلقائي لايتغير');
            $table->integer('zketo_code')->comment('كود البصمة');
            $table->string("employee_name", 300);
            $table->tinyInteger('employee_gender')->comment("1 ذكر - 2 أنثى");
            $table->foreignId("branch_id")->constrained()->default(1)->comment("الفرع");
            $table->foreignId("Qualifications_id")->nullable()->comment("المؤهل التعليمي")->references("id")->on("qualifications")->onUpdate("cascade");
            $table->string("Qualifications_year", 10)->nullable()->comment("سنة التخرج");
            $table->tinyInteger("graduation_estimate")->nullable()->comment("تقدير التخرج - واحد مقبول - اثنين جيد - ثلاثه جيد مرتفع - اربعه جيد جدا - خمسه امتياز");
            $table->string("Graduation_specialization", 225)->nullable()->comment("تخصص التخرج");
            $table->string("employee_national_idenity", 50)->nullable()->comment("رقم البطاقة الشخصية - او رقم الهوية");
            $table->date("employee_end_identityIDate")->nullable()->comment("تاريخ نهاية البطاقة الشخصية - بطاقة الهوية");
            $table->string("employee_identityPlace", 225)->nullable()->comment("مكان اصدار بطاقة الهوية الشخصية");
            $table->foreignId('blood_group_id')->comment('حقل فصيلة الدم ')->references('id')->on('blood_groups')->onUpdate('cascade');
            $table->foreignId('religion_id')->comment('حقل الديانة')->references('id')->on('religions')->onUpdate('cascade');
            $table->date("brith_date")->nullable()->comment("تاريخ الميلاد");
            $table->integer("employee_lang_id")->nullable();
            $table->string("employee_email", 100)->nullable();
            $table->string("staies_address", 300)->nullable();
            $table->integer("employee_social_status_id")->nullable();
            $table->string("emp_home_tel", 50)->nullable()->comment("رقم هاتف المنزل");
            $table->string("emp_work_tel", 50)->nullable()->comment("رقم هاتف العمل");
            $table->integer("country_id")->nullable()->comment("دولة الموظف");
            $table->integer("governorate_id")->nullable()->comment("محافظة الموظف");
            $table->integer("city_id")->nullable()->comment("مدينة الموظف");
            $table->string("notes",600)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
