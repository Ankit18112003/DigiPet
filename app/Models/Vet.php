<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vet extends Model
{
    use HasFactory;

    // The primary key is 'vet_id' instead of the default 'id'
    protected $primaryKey = 'vet_id';

    // Allow mass assignment for these attributes
    protected $fillable = [
        'name',
        'veterinarian',
        'phone',
        'address',
        'region',
        'services',
    ];

    // If your table doesn't use 'id' as the primary key AND it's not auto-incrementing, you might want this:
    // public $incrementing = false;

    // If you're not using timestamps (created_at, updated_at), you can disable them like this:
    // public $timestamps = false;

    // Optional: define any relationships here later (like appointments, pets, etc.)
}
