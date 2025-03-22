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
        Schema::table('quartaz', function (Blueprint $table) {
            $table->string('type');
            $table->string('ebill_no');
            $table->string('wbill_no');
            $table->string('rent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quartaz', function (Blueprint $table) {
            //
        });
    }
};
