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
        Schema::create('additional_salaries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('com_code');
            $table->tinyInteger('active')->default(0);
            $table->foreignId('added_by')->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('updated_by')->nullable()->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_salaries');
    }
};
