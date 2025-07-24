<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BoosterDose extends Model
{
    use HasFactory;

    protected $table = 'booster_dose'; // ✅ Matches actual table name

    protected $primaryKey = 'id';

    protected $fillable = [
        'vaccination_id',
        'pet_id',
        'dose_number',
        'ideal_date',
        'given_date',
        'status',
    ];

    protected $dates = [
        'ideal_date',
        'given_date',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function vaccination()
    {
        return $this->belongsTo(Vaccination::class, 'vaccination_id');
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'pet_id', 'pet_id');
    }

    public function getFormattedIdealDateAttribute()
    {
        return $this->ideal_date ? Carbon::parse($this->ideal_date)->format('Y-m-d') : null;
    }

    public function getFormattedGivenDateAttribute()
    {
        return $this->given_date ? Carbon::parse($this->given_date)->format('Y-m-d') : null;
    }
}
