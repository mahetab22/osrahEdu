<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketeInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('markete_infos', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('code');
            $table->string('url')->unique();
            $table->integer('visitors')->default(0);
            $table->integer('sales')->default(0);
            $table->double('amount')->default(0.0);
            $table->integer('num_of_courses')->default(0);
            $table->integer('user_id')->unsigned()->nullable()->default(null);
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('markete_infos');
    }
}
