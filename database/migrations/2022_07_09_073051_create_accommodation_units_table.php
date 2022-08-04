<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccommodationUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodation_units', function (Blueprint $table) {
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
            $table->foreignId('accommodation_id')->constrained('accommodation');
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
        Schema::table('accommodation_units', function (Blueprint $table) {
            $table->dropForeign('accommodation_units_accommodation_id_foreign');
        });
        Schema::dropIfExists('accommodation_units');
    }
}
