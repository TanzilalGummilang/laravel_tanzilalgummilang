<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'hospital_id' => mt_rand(1,3),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'address' => $this->faker->paragraph(),
            'phone' => '082'.$this->faker->randomNumber(9, true)
        ];
    }
}
