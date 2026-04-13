<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->numberBetween(10000, 500000),
            'address' => $this->faker->address(),
            'user_id' => User::factory(),
        ];
    }
}
