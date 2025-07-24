<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vets', function (Blueprint $table) {
            $table->id('vet_id');
            $table->string('name'); // Clinic or vet's name
            $table->string('veterinarian')->nullable(); // Dr. name(s)
            $table->string('phone')->nullable(); // One or more numbers
            $table->string('address')->nullable(); // Area/locality
            $table->string('region'); // North Goa or South Goa
            $table->string('services')->nullable(); // Services provided
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vets');
    }
};
