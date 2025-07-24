<?php

namespace Database\Factories;

use App\Models\Vet;
use Illuminate\Database\Eloquent\Factories\Factory;

class VetFactory extends Factory
{
    protected $model = Vet::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'specialization' => $this->faker->word(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'address' => $this->faker->address(),
        ];
    }
}
