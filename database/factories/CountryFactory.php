<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->country(),
            "shop" => fake()->numberBetween(1, 10),
            'google' => rand(10000, 99999999),
            'facebook' => rand(10000, 99999999),
            'analytics' => rand(10000, 99999999),
            'active' => rand(0, 1),
            'facebook_daily_budget' => rand(100, 1000),
            'google_daily_budget' => rand(100, 1000),
            'facebook_budget_currency' => rand(100, 1000),
            'google_budget_currency' => rand(100, 1000),
            'result-summary' => rand(0, 1),
        ];
    }
}
