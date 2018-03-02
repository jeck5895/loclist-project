<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportTargetListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_target_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('month_id')->unsigned()->foreign('month_id')->references('id')->on('report_months');
            $table->integer('target_increase_potential_client');
            $table->integer('target_no_of_calls_made');
            $table->integer('target_proposal_tobe_sent');
            $table->integer('target_no_formal_presentation');
            $table->integer('target_client_tobe_acquired');
            $table->year('target_year');
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
        Schema::dropIfExists('report_target_lists');
    }
}
