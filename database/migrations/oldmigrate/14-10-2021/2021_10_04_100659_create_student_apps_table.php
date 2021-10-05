<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_apps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('notes');
            $table->string('app');
            $table->unsignedBigInteger('app_id');
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('course_id');
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('app_id')->references('id')->on('applications_for_courses')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_apps');
    }
}
