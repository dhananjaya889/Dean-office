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
        Schema::create('paybills', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->integer('amount');
            $table->string('bill_id');
            $table->string('ref_id');
            $table->string('image');
            $table->string('bill_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paybills');
    }
};
