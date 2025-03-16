<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Collecteur>
 */
class CollecteurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => $this->faker->name,
            "email" => $this->faker->unique()->safeEmail,
            "password" => bcrypt('password'), 
            "email_verified_at" => $this->faker->dateTimeThisDecade(), 
            "remember_token" => Str::random(10), 
            'performance' => 0, 
        ];
    }
}
