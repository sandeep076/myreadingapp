<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePupilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pupils', function (Blueprint $table) {
            $table->increments('pupilID');
            $table->string('firstName');
            $table->string('surname');
            $table->string('readingLevel');
            $table->string('className');
            //defines parentID as a foreign key
            $table->unsignedInteger('parentID');
            $table->foreign('parentID')->references('parentID')->on('parents');
        });
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pupils');
    }
}
