<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    use HasFactory;

    /**
     * Table name if different from default (optional if using 'vaccinations')
     */
    // protected $table = 'vaccinations';

    /**
     * Primary key
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that can be mass-assigned
     */
    protected $fillable = [
        'pet_id',
        'vaccine_id',
        'date_administered',
        'total_booster_doses',
        'booster_gap_days',
        'notes',
    ];

    /**
     * Casts
     */
    protected $casts = [
        'date_administered' => 'date',
        'total_booster_doses' => 'integer',
        'booster_gap_days' => 'integer',
    ];

    /**
     * A vaccination belongs to a pet
     */
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'pet_id', 'pet_id');
    }

    /**
     * A vaccination belongs to a vaccine
     */
    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class, 'vaccine_id');
    }

    /**
     * A vaccination has many booster doses
     * Explicitly define foreign key and override table assumption
     */
    public function boosterDose()
    {
        return $this->hasMany(BoosterDose::class, 'vaccination_id');
    }
}
