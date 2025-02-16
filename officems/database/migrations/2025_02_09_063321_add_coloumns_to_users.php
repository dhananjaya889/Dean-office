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
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable()->after('email');
            $table->string('last_name')->nullable();
            $table->string('dob')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('nic')->nullable();
            $table->string('address_l1')->nullable();
            $table->string('address_l2')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('role')->nullable();
            $table->string('start_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('married')->nullable();
            $table->string('experience')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
