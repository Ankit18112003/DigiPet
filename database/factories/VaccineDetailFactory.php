<?php

namespace Database\Factories;

use App\Models\VaccineDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class VaccineDetailFactory extends Factory
{
    protected $model = VaccineDetail::class;

    public function definition(): array
    {
        return [
            'vaccine_name' => $this->faker->word(),
            'animal' => $this->faker->randomElement(['Dog', 'Cat', 'Bird']),
            'initial_dose' => $this->faker->numberBetween(1, 100),
            'first_dose' => $this->faker->numberBetween(1, 100),
            'second_dose' => $this->faker->numberBetween(1, 100),
        ];
    }
}
