<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccommodationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodation', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->integer('number_of_rooms');
            $table->integer('number_of_floors');
            $table->float('square');
            $table->integer('max_count_people');
            $table->integer('price');
            $table->boolean('is_available');
            $table->date('date_available_from');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('rent_info_id')->constrained('rent_info');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accommodation');
    }
}
