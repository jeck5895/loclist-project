<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusCategoryToStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('overall_statuses', function (Blueprint $table) {
            $table->integer('status_category_id')->unsigned()->foreign('status_category_id')->references('id')->on('status_categories')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('overall_statuses', function (Blueprint $table) {
            //
        });
    }
}
