<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_requests', function (Blueprint $table) {
            $table->id();
            $table->date('rent_date_from');
            $table->date('rent_date_to');
            $table->string('comment')->nullable();
            $table->integer('total_price');
            $table->integer('number_of_people');
            $table->enum('check_status', ['confirmed', 'rejected', 'unchecked'])->default('unchecked');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('accommodation_id')->constrained('accommodation');
            $table->foreignId('payment_method_id')->constrained('payment_methods');
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
        Schema::dropIfExists('rent_requests');
    }
}
