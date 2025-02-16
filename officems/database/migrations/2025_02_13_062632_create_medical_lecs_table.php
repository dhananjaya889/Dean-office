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
        Schema::create('medical_lecs', function (Blueprint $table) {
            $table->id();
            $table->string('st_name');
            $table->string('st_address');
            $table->string('st_contact');
            $table->string('register_number');
            $table->string('academic_year');
            $table->string('level');
            $table->string('semester_year');
            $table->string('degree_programe');
            $table->json('subject_details');
            $table->string('medical_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_lecs');
    }
};
