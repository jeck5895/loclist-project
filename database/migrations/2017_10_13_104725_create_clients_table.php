<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('entry_by')->foreign('entry_by')->references('uid')->on('users');
            $table->integer('overall_status')->foreign('overall_status')->references('id')->on('overall_status');
            $table->timestamp('entry_date');
            $table->string('client_name', 90);
            $table->integer('industry')->foreign('industry')->references('id')->on('industry');
            $table->integer('nationality')->foreign('nationality')->references('id')->on('nationalities');
            $table->string('iso_certf',60);
            $table->text('complete_mailing_address');
            $table->string('techno_park', 60);
            $table->text('street_address');
            $table->integer('province')->foreign('province')->references('id')->on('locations');
            $table->integer('area')->foreign('area')->references('id')->on('location_areas');
            $table->integer('zip_code');
            $table->string('website', 60);
            $table->string('primary_landline', 60);
            $table->string('other_landline', 60);
            $table->string('fax_number',60);
            $table->string('mobile_number', 50);
            $table->string('email_address', 50);
            $table->string('contact_person', 50);
            $table->string('gender', 50);
            $table->integer('department')->foreign('department')->references('id')->on('deparments')->nullable();
            $table->integer('position')->foreign('position')->references('id')->on('positions')->nullable();
            $table->integer('manpower')->foreign('manpower')->references('id')->on('client_manpower_types')->nullable();
            $table->integer('sourcing_practice')->foreign('sourcing_practice')->references('id')->on('client_sourcing_practices')->nullable();
            $table->integer('manpower_provider')->foreign('manpower_provider')->references('id')->on('manpower_providers')->nullable();
            $table->timestamp('contract_expiration')->nullable();
            $table->timestamp('biding_date')->nullable();
            $table->string('proposal', 50);
            $table->integer('company')->foreign('company')->references('id')->on('companies');
            $table->string('caller', 60);
            $table->timestamp('date_of_call')->nullable();
            $table->boolean('confirmation_preCall')->nullable();
            $table->boolean('productive_call')->nullable();
            $table->boolean('proposal_sent')->nullable();
            $table->integer('client_reponse')->foreign('client_response')->references('id')->on('client_responses');
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
        Schema::dropIfExists('clients');
    }
}
