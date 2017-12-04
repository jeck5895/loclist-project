<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientManpowerProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_manpower_providers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned()->foreign('client_id')->references('id')->on('clients');
            $table->string('manpower_provider', 200);
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
        Schema::dropIfExists('client_manpower_providers');
    }
}
