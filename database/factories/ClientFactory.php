<?php

namespace Database\Factories;
use Illuminate\Support\Str;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "collecteur_id" => null, 
            "name" => $this->faker->name, 
            "email" => $this->faker->unique()->safeEmail, 
            "password" => bcrypt('password'), 
            "email_verified_at" => $this->faker->dateTimeThisDecade(), 
            "remember_token" => Str::random(10), 
            'balance' => $this->faker->numberBetween(1, 50), 
        ];
    }
}
