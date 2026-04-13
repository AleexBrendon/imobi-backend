<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractFactory extends Factory
{
    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'property_id' => Property::factory(),
            'title' => $this->faker->word(),
            'expires_at' => now()->addDays(30),
            'status' => 'active'
        ];
    }
}
