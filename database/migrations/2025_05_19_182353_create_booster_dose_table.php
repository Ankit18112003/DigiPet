<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoosterDoseTable extends Migration
{
    public function up()
    {
        Schema::create('booster_dose', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vaccination_id');
            $table->unsignedBigInteger('pet_id');
            $table->integer('dose_number'); // 1st, 2nd, etc.
            $table->date('ideal_date'); // calculated from booster gap
            $table->date('given_date')->nullable(); // null until actually administered
            $table->timestamps();

            $table->foreign('vaccination_id')->references('id')->on('vaccinations')->onDelete('cascade');
            $table->foreign('pet_id')->references('pet_id')->on('pets')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('booster_dose');
    }
}
