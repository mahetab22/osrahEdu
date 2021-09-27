<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaidAboutUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('said_about_us', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username');
            $table->integer('rate')->default(0)->nullable();
            $table->string('comment');
            $table->string('job');
            $table->string('photo');
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
        Schema::dropIfExists('said_about_us');
    }
}
