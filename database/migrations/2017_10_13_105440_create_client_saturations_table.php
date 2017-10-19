<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientSaturationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_saturations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->foreign('client_id')->references('id')->on('clients');
            $table->timestamp('saturation_date');
            $table->string('saturation_mode', 50);
            $table->text('proposal_by');
            $table->string('call_slip', 50);
            $table->timestamp('date_received')->nullable();
            $table->boolean('proposal_accepted');
            $table->string('manner_of_confirmation',50);
            $table->integer('client_response1')->foreign('client_response1')->references('id')->on('client_responses');
            $table->boolean('ff_calls_made');
            $table->timestamp('last_ffup_date')->nullable();
            $table->string('presentation_mode',50);
            $table->text('presentor'); //this will be stored as array of user_id
            $table->timestamp('date_presented')->nullable();
            $table->string('call_slip2',50);
            $table->integer('client_response2')->foreign('client_response2')->references('id')->on('client_responses');
            $table->integer('presentation_status')->foreign('presentation_status')->references('id')->on('presentation_statuses');
            $table->timestamp('ffup_meeting_date')->nullable();
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
        Schema::dropIfExists('client_saturations');
    }
}
