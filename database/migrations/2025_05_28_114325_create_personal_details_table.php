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
        Schema::create('personal_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId("employee_id")->constrained("employees")->onDelete("cascade");

            $table->integer("employee_military_id")->nullable();
            $table->date("employee_military_date_from")->nullable();
            $table->date("employee_military_date_to")->nullable();
            $table->string("employee_military_wepon")->nullable();
            $table->date("exemption_date")->nullable();
            $table->string("exemption_reason", 300)->nullable();
            $table->string("postponement_reason", 225)->nullable();

            $table->tinyInteger("does_has_Driving_License")->default(0);
            $table->string("driving_License_degree", 50)->nullable();
            $table->foreignId('driving_license_types_id')->nullable()->references('id')->on('driving__licenses')->onDelete("cascade");
            $table->tinyInteger("has_Relatives")->default(0);
            $table->string("Relatives_details", 600)->nullable();

            $table->tinyInteger("is_Disabilities_processes")->default(0);
            $table->string("Disabilities_processes", 500)->nullable();
            $table->string("employee_cafel")->nullable();
            $table->string("employee_pasport_no", 100)->nullable();
            $table->string("employee_pasport_from", 100)->nullable();
            $table->date("employee_pasport_exp")->nullable();
            $table->string("employee_Basic_stay_com",300)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_details');
    }
};
