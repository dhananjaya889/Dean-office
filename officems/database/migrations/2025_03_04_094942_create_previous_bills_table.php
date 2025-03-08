<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreviousBillsTable extends Migration
{
    public function up()
    {
        Schema::create('previous_bills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('bill_id');
            $table->date('date');
            $table->string('month');
            $table->decimal('amount', 10, 2);
            $table->integer('point');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('assign_user')->nullable();
            $table->unsignedBigInteger('assign_quartaz')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('previous_bills');
    }
}
