<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paiement>
 */
class PaiementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'montant' => $this->faker->numberBetween(1000, 10000),
            'date_paiement' => $this->faker->dateTimeBetween('-3 month', 'now'),
            'mode_paiement' => $this->faker->randomElement(['espèce', 'mobile money', 'virement']),
            'client_id' => $this->faker->numberBetween(18, 29),
            'collecteur_id' => '7', // ou null si nécessaire
            'status' => $this->faker->randomElement(['confirmé', 'annulé']),
        ];
    }
}
