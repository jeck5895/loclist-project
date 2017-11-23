<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropPresentationColumnsOnSaturation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_saturations', function (Blueprint $table) {
            $table->dropColumn(
                [
                    'presentation_mode', 
                    'presentor', 
                    'date_presented',
                    'call_slip2',
                    'client_response2',
                    'presentation_status',
                    'ffup_meeting_date',
                    'action_plan'
                ]
            );
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
