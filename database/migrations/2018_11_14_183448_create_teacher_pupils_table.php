<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherPupilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_pupils', function (Blueprint $table) {
            $table->unsignedInteger('teacherID');
            $table->foreign('teacherID')->references('teacherID')->on('teachers');

            $table->unsignedInteger('pupilID');
            $table->foreign('pupilID')->references('pupilID')->on('pupils');
            
            $table->string('academicYear');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('teacher_pupils');
    }
}
