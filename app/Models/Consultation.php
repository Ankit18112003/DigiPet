<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $primaryKey = 'consultation_id';

    protected $fillable = [
        'pet_id',
        'vet_id',
        'consultation_date',
        'purpose',
        'notes',
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'pet_id', 'pet_id');
    }

    public function vet()
    {
        return $this->belongsTo(Vet::class, 'vet_id', 'vet_id');
    }
}
