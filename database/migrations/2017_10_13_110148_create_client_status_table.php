<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_status', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->foreign('client_id')->references('id')->on('clients');
            $table->timestamp('status_as_of')->nullable();
            $table->string('status', 50);
            $table->timestamp('date_acquired')->nullable();
            $table->integer('acquired_by')->foreign('acquired_by')->references('uid')->on('users')->nullable();
            $table->string('signed_contract')->nullable();
            $table->string('manner_of_acquisition',50)->nullable();
            $table->string('name_of_related_client', 50)->nullable();
            $table->string('initial_hc_acquired', 50)->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('client_status');
    }
}
