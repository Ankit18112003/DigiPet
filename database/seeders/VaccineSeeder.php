<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class VaccineSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $vaccines = [

            // 🐶 Dog - Core
            ['vaccine_name' => 'Canine Parvovirus', 'animal_type' => 'Dog', 'category' => 'Core', 'booster_count' => 2, 'booster_gap_days' => 21, 'initial_age_weeks' => 6, 'booster_frequency_days' => 365],
            ['vaccine_name' => 'Canine Distemper', 'animal_type' => 'Dog', 'category' => 'Core', 'booster_count' => 2, 'booster_gap_days' => 28, 'initial_age_weeks' => 6, 'booster_frequency_days' => 365],
            ['vaccine_name' => 'Canine Adenovirus', 'animal_type' => 'Dog', 'category' => 'Core', 'booster_count' => 1, 'booster_gap_days' => 28, 'initial_age_weeks' => 6, 'booster_frequency_days' => 365],
            ['vaccine_name' => 'Rabies', 'animal_type' => 'Dog', 'category' => 'Core', 'booster_count' => 1, 'booster_gap_days' => 365, 'initial_age_weeks' => 12, 'booster_frequency_days' => 365],
            ['vaccine_name' => 'Canine Hepatitis', 'animal_type' => 'Dog', 'category' => 'Core', 'booster_count' => 1, 'booster_gap_days' => 28, 'initial_age_weeks' => 8, 'booster_frequency_days' => 365],

            // 🐶 Dog - Non-Core
            ['vaccine_name' => 'Leptospirosis', 'animal_type' => 'Dog', 'category' => 'Non-Core', 'booster_count' => 2, 'booster_gap_days' => 21, 'initial_age_weeks' => 8, 'booster_frequency_days' => 365],
            ['vaccine_name' => 'Bordetella (Kennel Cough)', 'animal_type' => 'Dog', 'category' => 'Non-Core', 'booster_count' => 1, 'booster_gap_days' => 0, 'initial_age_weeks' => 8, 'booster_frequency_days' => 365],
            ['vaccine_name' => 'Lyme Disease', 'animal_type' => 'Dog', 'category' => 'Non-Core', 'booster_count' => 1, 'booster_gap_days' => 21, 'initial_age_weeks' => 9, 'booster_frequency_days' => 365],
            ['vaccine_name' => 'Canine Coronavirus', 'animal_type' => 'Dog', 'category' => 'Non-Core', 'booster_count' => 1, 'booster_gap_days' => 21, 'initial_age_weeks' => 6, 'booster_frequency_days' => 365],
            ['vaccine_name' => 'Giardia', 'animal_type' => 'Dog', 'category' => 'Non-Core', 'booster_count' => 2, 'booster_gap_days' => 21, 'initial_age_weeks' => 8, 'booster_frequency_days' => 365],

            // 🐱 Cat - Core
            ['vaccine_name' => 'Feline Panleukopenia', 'animal_type' => 'Cat', 'category' => 'Core', 'booster_count' => 2, 'booster_gap_days' => 21, 'initial_age_weeks' => 6, 'booster_frequency_days' => 365],
            ['vaccine_name' => 'Feline Herpesvirus', 'animal_type' => 'Cat', 'category' => 'Core', 'booster_count' => 2, 'booster_gap_days' => 21, 'initial_age_weeks' => 6, 'booster_frequency_days' => 365],
            ['vaccine_name' => 'Feline Calicivirus', 'animal_type' => 'Cat', 'category' => 'Core', 'booster_count' => 2, 'booster_gap_days' => 21, 'initial_age_weeks' => 6, 'booster_frequency_days' => 365],
            ['vaccine_name' => 'Rabies', 'animal_type' => 'Cat', 'category' => 'Core', 'booster_count' => 1, 'booster_gap_days' => 365, 'initial_age_weeks' => 12, 'booster_frequency_days' => 365],
            ['vaccine_name' => 'Feline Leukemia (FeLV)', 'animal_type' => 'Cat', 'category' => 'Core', 'booster_count' => 1, 'booster_gap_days' => 21, 'initial_age_weeks' => 8, 'booster_frequency_days' => 365],

            // 🐱 Cat - Non-Core
            ['vaccine_name' => 'Chlamydia felis', 'animal_type' => 'Cat', 'category' => 'Non-Core', 'booster_count' => 1, 'booster_gap_days' => 21, 'initial_age_weeks' => 9, 'booster_frequency_days' => 365],
            ['vaccine_name' => 'Bordetella bronchiseptica', 'animal_type' => 'Cat', 'category' => 'Non-Core', 'booster_count' => 1, 'booster_gap_days' => 0, 'initial_age_weeks' => 8, 'booster_frequency_days' => 365],
            ['vaccine_name' => 'Feline Immunodeficiency Virus', 'animal_type' => 'Cat', 'category' => 'Non-Core', 'booster_count' => 3, 'booster_gap_days' => 28, 'initial_age_weeks' => 8, 'booster_frequency_days' => 365],
            ['vaccine_name' => 'Ringworm', 'animal_type' => 'Cat', 'category' => 'Non-Core', 'booster_count' => 2, 'booster_gap_days' => 14, 'initial_age_weeks' => 10, 'booster_frequency_days' => 365],
            ['vaccine_name' => 'Feline Coronavirus (FCoV)', 'animal_type' => 'Cat', 'category' => 'Non-Core', 'booster_count' => 1, 'booster_gap_days' => 21, 'initial_age_weeks' => 6, 'booster_frequency_days' => 365],
        ];

        foreach ($vaccines as &$vaccine) {
            $vaccine['created_at'] = $now;
            $vaccine['updated_at'] = $now;
        }

        DB::table('vaccines')->insert($vaccines);
    }
}
