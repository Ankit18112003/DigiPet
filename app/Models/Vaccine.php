<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    protected $fillable = [
        'vaccine_name',
        'animal_type',
        'category',
        'booster_count',
        'booster_gap_days',
        'initial_age_weeks',
        'booster_frequency_days',
    ];

    /**
     * Get all vaccinations using this vaccine.
     */
    public function vaccinations()
    {
        return $this->hasMany(Vaccination::class);
    }

    /**
     * Get all booster doses related to this vaccine, if applicable.
     */
    public function boosters()
    {
        return $this->hasMany(Booster::class);
    }
}
