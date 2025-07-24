<?php

namespace Database\Factories;

use App\Models\Vaccination;
use Illuminate\Database\Eloquent\Factories\Factory;

class VaccinationFactory extends Factory
{
    protected $model = Vaccination::class;

    public function definition(): array
    {
        return [
            'vaccine_id' => $this->faker->numberBetween(1, 10),
            'pet_id' => $this->faker->numberBetween(1, 50),
            'type' => $this->faker->word(),
            'date' => $this->faker->date(),
            'due_date' => $this->faker->date('Y-m-d', 'now +1 year'),
            'vet_id' => $this->faker->numberBetween(1, 10),
            'state' => $this->faker->boolean(),
        ];
    }
}
