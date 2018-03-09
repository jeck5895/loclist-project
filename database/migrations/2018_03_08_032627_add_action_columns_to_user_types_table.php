<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActionColumnsToUserTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_types', function (Blueprint $table) {
            $table->boolean('add_clients')->default(0);
            $table->boolean('add_client_calls')->default(0);
            $table->boolean('add_client_saturations')->default(0);
            $table->boolean('add_client_presentations')->default(0);
            $table->boolean('add_client_acquisitions')->default(0);

            $table->boolean('edit_clients')->default(0);
            $table->boolean('edit_client_calls')->default(0);
            $table->boolean('edit_client_saturations')->default(0);
            $table->boolean('edit_client_presentations')->default(0);
            $table->boolean('edit_client_acquisitions')->default(0);
            $table->boolean('delete_clients')->default(0);
            
            $table->boolean('delete_client_calls')->default(0);
            $table->boolean('delete_client_saturations')->default(0);
            $table->boolean('delete_client_presentations')->default(0);
            $table->boolean('delete_client_acquisitions')->default(0);

            $table->boolean('add_user')->default(0);
            $table->boolean('edit_user')->default(0);
            $table->boolean('delete_user')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_types', function (Blueprint $table) {
            //
        });
    }
}
