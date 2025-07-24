<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('deworming', function (Blueprint $table) {
        $table->id('deworming_id'); // Primary key
        $table->unsignedBigInteger('pet_id'); // Foreign key to pets table
        $table->string('type'); // Type of deworming
        $table->date('date'); // Date of deworming
        $table->date('due_date')->nullable(); // Next deworming due date
        $table->unsignedBigInteger('vet_id'); // Foreign key to vets table
        $table->timestamps();

        // Foreign key constraints
        $table->foreign('pet_id')->references('pet_id')->on('pets')->onDelete('cascade');
        $table->foreign('vet_id')->references('vet_id')->on('vets')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deworming');
    }
};
