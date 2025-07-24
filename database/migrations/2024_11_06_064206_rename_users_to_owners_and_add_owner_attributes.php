<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameUsersToOwnersAndAddOwnerAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Rename 'owners' table back to 'users'
        Schema::rename('owners', 'users');

        // Make sure any foreign keys are updated, e.g., update references to 'owner_id' to 'user_id'
        Schema::table('pets', function (Blueprint $table) {
            $table->renameColumn('owner_id', 'user_id'); // Renaming the foreign key column
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Add foreign key constraint back
        });

        Schema::table('vaccinations', function (Blueprint $table) {
            $table->renameColumn('owner_id', 'user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Add any additional adjustments here if necessary
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // If rolling back, change 'users' back to 'owners' and revert any other changes
        Schema::rename('users', 'owners');

        Schema::table('pets', function (Blueprint $table) {
            $table->renameColumn('user_id', 'owner_id');
            $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade');
        });

        Schema::table('vaccinations', function (Blueprint $table) {
            $table->renameColumn('user_id', 'owner_id');
            $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade');
        });
    }
}