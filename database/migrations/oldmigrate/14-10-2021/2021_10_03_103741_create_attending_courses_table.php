<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendingCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attending_courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('student_course');
            $table->timestamps();
            $table->foreign('student_course')->references('id')->on('stusubscriptioncourse')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attending_courses');
    }
}
