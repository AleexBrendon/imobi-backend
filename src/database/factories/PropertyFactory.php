<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->word(),
            'description' => fake()->text(),
            'price' => fake()->numberBetween(10000, 500000),
            'address' => fake()->address(),
            'user_id' => \App\Models\User::factory(),
            'company_id' => Company::factory(),
        ];
    }
}
