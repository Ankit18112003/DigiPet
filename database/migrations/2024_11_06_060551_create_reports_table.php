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
    Schema::create('reports', function (Blueprint $table) {
        $table->id('report_id'); // Primary key
        $table->unsignedBigInteger('pet_id'); // Foreign key to pets table
        $table->unsignedBigInteger('vet_id'); // Foreign key to vets table
        $table->date('report_date'); // Date of report
        $table->text('description')->nullable(); // Summary of the report
        $table->text('findings')->nullable(); // Vet's findings
        $table->text('prescription')->nullable(); // Prescribed medications
        $table->text('remark')->nullable(); // Vet's remarks
        $table->text('follow_up')->nullable(); // Follow-up recommendations
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
        Schema::dropIfExists('reports');
    }
};
