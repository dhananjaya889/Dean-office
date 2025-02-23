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
        Schema::create('atendances', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('present')->default(0);
            $table->integer('absent')->default(0);
            $table->string('month');     
            $table->string('user_type');  
            $table->string('file_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atendances');
    }
};
