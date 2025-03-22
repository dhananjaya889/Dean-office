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
        Schema::create('check_lists', function(Blueprint $table){
            $table->id();
            $table->string('user_id');
            $table->string('quartz_id');
            $table->string('no');
            $table->string('item');
            $table->string('available_qty');
            $table->string('working_qty');
            $table->string('damage_qty');
            $table->string('remark');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('check_list');
    }
};
