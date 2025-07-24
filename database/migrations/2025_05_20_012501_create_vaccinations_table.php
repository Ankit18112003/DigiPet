<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('vaccinations');

Schema::create('vaccinations', function (Blueprint $table) {
    $table->id();
    
    // Pet ID must match type from pets.pet_id (VARCHAR)
    $table->string('pet_id');
    $table->foreign('pet_id')->references('pet_id')->on('pets')->onDelete('cascade');
    
    // Vaccine ID is INTEGER and links to vaccines.id
    $table->unsignedBigInteger('vaccine_id');
    $table->foreign('vaccine_id')->references('id')->on('vaccines')->onDelete('cascade');

    $table->date('date_administered');
    $table->integer('total_booster_doses')->default(0);
    $table->integer('booster_gap_days')->default(0);
    $table->text('notes')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccinations');
    }
};
