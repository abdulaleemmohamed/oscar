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
        Schema::create('employment_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId("employee_id")->constrained("employees")->onDelete("cascade");
            $table->foreignId("employee_Departments_code")->constrained("departments");
            $table->foreignId("employee_jobs_id")->constrained("job_categories");
            $table->foreignId("shift_type_id")->nullable()->constrained("work_shifts");
            $table->decimal("daily_work_hour", 10, 2)->nullable();
            $table->decimal("employee_sal", 10, 2)->default(0);
            $table->tinyInteger("Functiona_status")->default(0);
            $table->tinyInteger("does_has_ateendance")->default(1);
            $table->tinyInteger("is_has_fixced_shift")->nullable();
            $table->tinyInteger("MotivationType")->default(0);
            $table->decimal("Motivation", 10, 2)->default(0);
            $table->tinyInteger("isSocialnsurance")->default(0);
            $table->decimal("Socialnsurancecutmonthely", 10, 2)->nullable();
            $table->string("SocialnsuranceNumber",50)->nullable();
            $table->tinyInteger("ismedicalinsurance")->default(0);
            $table->decimal("medicalinsurancecutmonthely", 10, 2)->nullable();
            $table->string("medicalinsuranceNumber",50)->nullable();
            $table->tinyInteger("sal_cach_or_visa")->default(1);
            $table->tinyInteger("is_active_for_Vaccation")->default(0);
            $table->tinyInteger("is_done_Vaccation_formula")->default(0);
            $table->tinyInteger("Does_have_fixed_allowances")->default(0);
            $table->string("urgent_person_details", 600)->nullable();
            $table->date("emp_start_date")->nullable()->comment("تاريخ بدء العمل للموظف");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_details');
    }
};
