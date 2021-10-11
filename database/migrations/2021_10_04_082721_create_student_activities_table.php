<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('notes');
            $table->string('activity');
            $table->unsignedBigInteger('activity_id');
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('course_id');
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('activity_id')->references('id')->on('activities')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_activities');
    }
}
