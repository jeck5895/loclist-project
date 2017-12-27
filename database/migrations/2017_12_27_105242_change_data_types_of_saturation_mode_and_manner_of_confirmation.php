<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDataTypesOfSaturationModeAndMannerOfConfirmation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_saturations', function (Blueprint $table) {
            $table->integer('saturation_mode')->unsigned()->foreign('saturation_mode')->references('id')->on('mode_of_saturations')->change();
            $table->integer('manner_of_confirmation')->unsigned()->foreign('manner_of_confirmation')->references('id')->on('manner_of_confirmations')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_saturations', function (Blueprint $table) {
            //
        });
    }
}
