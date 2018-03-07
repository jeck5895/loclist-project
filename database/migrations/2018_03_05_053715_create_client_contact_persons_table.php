<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientContactPersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_contact_persons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned()->foreign('client_id')->references('id')->on('clients');
            $table->string('first_name', 50);
            $table->string('last_name',50);
            $table->string('gender', 50);
            $table->string('mobile_number', 50);
            $table->string('email', 50);
            $table->integer('department')->unsigned()->foreign('department')->references('id')->on('departments');
            $table->integer('position')->unsigned()->foreign('position')->references('id')->on('positions');
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
        Schema::dropIfExists('client_contact_persons');
    }
}
