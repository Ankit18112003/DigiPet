<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'emergency_contact_phone' => $this->faker->phoneNumber,
        ];
    }
}
