<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientSourcingPracticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_sourcing_practices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned()->foreign('client_id')->references('id')->on('clients');
            $table->integer('sourcing_practice_id')->unsigned()->foreign('sourcing_practice_id')->references('id')->on('sourcing_practices');
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
        Schema::dropIfExists('client_sourcing_practices');
    }
}
