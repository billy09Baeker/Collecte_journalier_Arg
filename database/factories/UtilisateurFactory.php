<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Utilisateur>
 */
class UtilisateurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'date_naissance' => $this->faker->date('Y-m-d', '-18 years'),
            'lieu_naissance' => $this->faker->city,
            'sexe' => $this->faker->randomElement(['masculin', 'féminin']),
            'email' => $this->faker->unique()->safeEmail,
            'telephone' => $this->faker->unique()->numerify('6########'),
            'adresse' => $this->faker->address,
            'password' => 'password', // Mot de passe en clairs
            'role' => 'client',
            'added_by' => '7'
            ];
    }
}
