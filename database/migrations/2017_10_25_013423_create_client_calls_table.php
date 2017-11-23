<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_calls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('caller')->foreign('caller')->references('id')->on('clients');
            $table->timestamp('date_of_call')->nullable();
            $table->boolean('confirmation_preCall')->nullable();
            $table->boolean('productive_call')->nullable();
            $table->boolean('proposal_sent')->nullable();
            $table->text('client_reponse');
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
        Schema::dropIfExists('client_calls');
    }
}
