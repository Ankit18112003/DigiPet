<?php

namespace Database\Factories;

use App\Models\Consultation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConsultationFactory extends Factory
{
    protected $model = Consultation::class;

    public function definition(): array
    {
        return [
            'pet_id' => $this->faker->numberBetween(1, 50),
            'vet_id' => $this->faker->numberBetween(1, 10),
            'consultation_date' => $this->faker->date(),
            'purpose' => $this->faker->text(),
            'notes' => $this->faker->text(),
        ];
    }
}
