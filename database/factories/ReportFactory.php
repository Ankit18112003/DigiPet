<?php

namespace Database\Factories;

use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    protected $model = Report::class;

    public function definition(): array
    {
        return [
            'pet_id' => $this->faker->numberBetween(1, 50),
            'vet_id' => $this->faker->numberBetween(1, 10),
            'report_date' => $this->faker->date(),
            'description' => $this->faker->text(),
            'findings' => $this->faker->text(),
            'prescription' => $this->faker->text(),
            'remark' => $this->faker->sentence(),
            'follow_up' => $this->faker->sentence(),
        ];
    }
}
