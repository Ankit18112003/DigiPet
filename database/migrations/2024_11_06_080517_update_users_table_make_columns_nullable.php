<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTableMakeColumnsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Making columns nullable
            $table->string('address')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->string('gender')->nullable()->change();
            $table->string('emergency_contact_phone')->nullable()->change();
            $table->timestamp('email_verified_at')->nullable()->change();
            $table->rememberToken()->nullable()->change();
            // Do not change 'name', 'email', 'password' as they must remain NOT NULL
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Revert columns back to NOT NULL
            $table->string('address')->nullable(false)->change();
            $table->string('phone')->nullable(false)->change();
            $table->string('gender')->nullable(false)->change();
            $table->string('emergency_contact_phone')->nullable(false)->change();
            $table->timestamp('email_verified_at')->nullable(false)->change();
            $table->rememberToken()->nullable(false)->change();
        });
    }
}
