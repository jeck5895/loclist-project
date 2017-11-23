<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientPresentationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_presentations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('presentation_mode');
            $table->text('presentor');//this will be stored as array of user_id
            $table->timestamp('date_presented')->nullable();
            $table->string('call_slip2',50);
            $table->integer('client_response2')->foreign('client_response2')->references('id')->on('client_responses');
            $table->integer('presentation_status')->foreign('presentation_status')->references('id')->on('presentation_statuses');
            $table->timestamp('follow_up_meeting_date')->nullable();
            $table->integer('action_plan')->foreign('action_plan')->references('id')->on('action_plans');
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
        Schema::dropIfExists('client_presentations');
    }
}
