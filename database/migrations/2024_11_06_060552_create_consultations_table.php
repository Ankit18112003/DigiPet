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
    Schema::create('consultations', function (Blueprint $table) {
        $table->id('consultation_id'); // Primary key
        $table->unsignedBigInteger('pet_id'); // Foreign key to pets table
        $table->unsignedBigInteger('vet_id'); // Foreign key to vets table
        $table->date('consultation_date'); // Date of consultation
        $table->text('purpose'); // Purpose of the consultation
        $table->text('notes')->nullable(); // Vet’s notes
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
        Schema::dropIfExists('consultations');
    }
};
