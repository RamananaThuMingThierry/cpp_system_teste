<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Etudiant>
 */
class EtudiantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->sentence,
            'prenom' => $this->faker->sentence,
            'promotion' =>  $this->faker->randomElement(['Licence', 'Master 1', 'Master 2']),
            'genre' =>  $this->faker->randomElement(['Homme', 'Femme', 'Autres']),
        ];
    }
}
