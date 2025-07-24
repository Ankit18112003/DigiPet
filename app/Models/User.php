<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The name of the table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';  // Ensure the table is explicitly named 'users'

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'address',  // New columns
        'phone',    // New columns
    ];

    /**
     * Get the pets for the user.
     */
    public function pets()
    {
        return $this->hasMany(Pet::class, 'owner_id');
    }

    public function vaccinations(){
        return $this->hasMany(Vaccination::class, 'id');
}
}