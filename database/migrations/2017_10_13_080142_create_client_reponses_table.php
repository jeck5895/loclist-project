<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientReponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Response Types:
         *  1 - First Response
         *  2 - Response After Saturation
         *  3 - Response After Presentation
         */
        Schema::create('client_reponses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reponse_name',120);
            $table->tinyInteger('response_type'); 
            $table->timestamps();
            $table->tinyInteger('is_active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_reponses');
    }
}
