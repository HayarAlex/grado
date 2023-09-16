<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');           
            $table->integer('rol_id')->unsigned()->default(4);
            $table->string('name',45);
            $table->string('paternal',45)->nullable();
            $table->string('maternal',45)->nullable();
            $table->string('gender',45)->nullable();
            $table->string('address',50)->nullable();
            $table->string('email',45)->unique();
            $table->string('ci',45)->unique()->nullable();
            $table->string('nit',45)->unique()->nullable();
            $table->integer('state')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default(0);
            $table->string('phone',15)->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('rol_id')->references('rol_id')->on('rols');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
