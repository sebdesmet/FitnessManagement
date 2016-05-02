<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {

            $table->increments('id');
            $table->string('firstname',20);
            $table->string('lastname',20);
            $table->string('email',30)->unique();
            $table->string('phone', 15);
            $table->string('localisation',20);
            $table->string('token',255);
            $table->string('password',50);
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
        //
    }
}
