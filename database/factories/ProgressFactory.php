<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Progress>
 */
class ProgressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'poids' => $this->faker->numberBetween(50, 150), // Example range for poids (weight)
            'taille' => $this->faker->numberBetween(150, 200), // Example range for taille (height)
            'age' => $this->faker->numberBetween(18, 60), // Example range for age
            'chest' => $this->faker->numberBetween(80, 120), // Example range for chest measurement
            'bicep' => $this->faker->numberBetween(20, 40), // Example range for bicep measurement
            'leg' => $this->faker->numberBetween(60, 120), // Example range for leg measurement
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id; // Assuming you have a User model
            },
            'status' => 'Non términé', // Default status
        ];
    }
}
