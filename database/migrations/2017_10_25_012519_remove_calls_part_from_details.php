<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveCallsPartFromDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            //
            $table->dropColumn(['caller','date_of_call','confirmation_preCall','productive_call','proposal_sent','client_reponse']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn(['caller','date_of_call','confirmation_preCall','proposal_sent','productive_call','client_reponse']);
        });
    }
}
