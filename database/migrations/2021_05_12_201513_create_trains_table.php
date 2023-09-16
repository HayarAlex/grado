<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trains', function (Blueprint $table) {
            $table->increments('train_id');
            $table->integer('id')->unsigned();
            $table->integer('sport_id')->unsigned();
            $table->string('description');
            $table->integer('state_id')->default(1);
            $table->timestamps();
            $table->foreign('id')->references('id')->on('users');
            $table->foreign('sport_id')->references('sport_id')->on('sports');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trains');
    }
}
