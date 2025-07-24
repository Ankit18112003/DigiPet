<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Pet extends Model
{
    use HasFactory;

    // ✅ Use UUID as primary key
    protected $primaryKey = 'pet_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'pet_id', 'owner_id', 'name', 'type', 'breed', 'color', 'dob', 'microchip_number'
    ];

    // ✅ Generate UUID automatically on create
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->pet_id)) {
                $model->pet_id = (string) Str::uuid();
            }
        });
    }

    // ✅ Important: Use pet_id for route binding
    public function getRouteKeyName()
    {
        return 'pet_id';
    }

    // Accessor for age (optional)
    public function getAgeAttribute()
    {
        return Carbon::parse($this->dob)->age;
    }

    // Relationships
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function vaccinations()
    {
        return $this->hasMany(Vaccination::class, 'pet_id', 'pet_id');
    }
}
