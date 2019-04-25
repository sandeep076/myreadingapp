<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReadingRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reading_records', function (Blueprint $table) {
            $table->increments('recordID');

            $table->unsignedInteger('pupilID');
            $table->foreign('pupilID')->references('pupilID')->on('pupils');

            $table->string('ISBN');
            $table->foreign('ISBN')->references('ISBN')->on('books');

            $table->date('dateAssigned');
            $table->date('dueDate');
            $table->date('commentDate');
            $table->string('comment', 5000);

            $table->unsignedInteger('teacherID');
            $table->foreign('teacherID')->references('teacherID')->on('teachers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reading_records');
    }
}
