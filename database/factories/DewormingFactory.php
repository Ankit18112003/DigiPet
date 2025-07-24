<?php

namespace Database\Factories;

use App\Models\Deworming;
use Illuminate\Database\Eloquent\Factories\Factory;

class DewormingFactory extends Factory
{
    protected $model = Deworming::class;

    public function definition(): array
    {
        return [
            'pet_id' => $this->faker->numberBetween(1, 50),
            'type' => $this->faker->word(),
            'date' => $this->faker->date(),
            'due_date' => $this->faker->date('Y-m-d', 'now +6 months'),
            'vet_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
