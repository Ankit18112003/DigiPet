<?php

namespace Database\Factories;

use App\Models\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;

class PetFactory extends Factory
{
    protected $model = Pet::class;

    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['Dog', 'Cat', 'Bird']),
            'species' => $this->faker->word(),
            'breed' => $this->faker->word(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'dob' => $this->faker->date(),
            'owner_id' => $this->faker->numberBetween(1, 10), // Assuming there are owners with IDs 1-10
        ];
    }
}
