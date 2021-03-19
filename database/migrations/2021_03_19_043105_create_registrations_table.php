<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('dob');
            $table->string('address');
            $table->string('mobile');
            $table->string('email')->unique();
            $table->date('start_date');
            $table->bigInteger('start_time')->unsigned();
            $table->foreign('start_time')->references('id')->on('start_times');
            $table->bigInteger('learning_hour')->unsigned();
            $table->foreign('learning_hour')->references('id')->on('learning_hours');
            $table->bigInteger('duration')->unsigned();
            $table->foreign('duration')->references('id')->on('durations');
            $table->bigInteger('course')->unsigned();
            $table->foreign('course')->references('id')->on('courses');
            $table->string('avatar');
            $table->date('end_date');
            $table->string('end_time');
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
        Schema::dropIfExists('registrations');
    }
}
