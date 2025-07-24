// app/Models/Notification.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'pet_id', 'owner_id', 'booster_id', 'message'
    ];

    public function pet() {
        return $this->belongsTo(Pet::class, 'pet_id', 'pet_id');
    }

    public function booster() {
        return $this->belongsTo(BoosterDose::class, 'booster_id');
    }
}
