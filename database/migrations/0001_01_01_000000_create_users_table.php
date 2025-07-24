<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // This will create the 'id' column, which is now used as the primary key
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            // Add any extra attributes that were added to the `owner` table
            $table->string('address')->nullable(); // Example of a new column
            $table->string('phone')->nullable(); // Example of a new column
            $table->string('gender')->nullable(); // Example of a new column
            $table->string('emergency_contact_phone')->nullable(); // Example of a new column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
