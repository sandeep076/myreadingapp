<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('teacherID');
            $table->string('firstName');
            $table->string('surname');
            $table->string('username');
            $table->string('password');
            $table->string('emailAddress');
            $table->string('className');

            $table->unsignedInteger('schoolID');
            $table->foreign('schoolID')->references('schoolID')->on('schools');

            $table->rememberToken();
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
        Schema::drop('teachers');
    }
}
