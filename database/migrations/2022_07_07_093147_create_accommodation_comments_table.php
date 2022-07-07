<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccommodationCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodation_comments', function (Blueprint $table) {
            $table->foreignId('accommodation_id')->constrained('accommodation');
            $table->foreignId('user_id')->constrained('users');
            $table->text('comment');
            $table->float('total_rating');
            $table->integer('location');
            $table->integer('facilities');
            $table->integer('service');
            $table->integer('price');
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
        Schema::dropIfExists('accommodation_comments');
    }
}
