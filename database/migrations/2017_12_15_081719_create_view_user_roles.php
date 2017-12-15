<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewUserRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE OR REPLACE VIEW `vw_user_roles` 
        AS SELECT 
            u.id,
            u.uid,
            u.name,
            u.initial,
            u.email,
            t.userType,
            u.created_at,
            u.updated_at,
            u.user_img,
            u.is_active
        FROM users u
        INNER JOIN user_types t ON u.userType = t.id
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW `vw_user_roles`');
    }
}
