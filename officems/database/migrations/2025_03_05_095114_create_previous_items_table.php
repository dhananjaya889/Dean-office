<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('previous_items', function (Blueprint $table) {
            $table->id();
            $table->string('item_id');
            $table->string('name');
            $table->string('item_add_date');
            $table->text('description');
            $table->string('quartaz_num')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('previous_items');
    }
};
