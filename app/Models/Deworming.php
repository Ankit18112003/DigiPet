<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deworming extends Model
{
    use HasFactory;

    // Specify the correct table name
    protected $table = 'deworming';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'pet_id',
        'type',
        'date',
        'due_date',
        'vet_id',
    ];
}
