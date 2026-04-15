<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;
use App\Models\Company;

class ActivityFactory extends Factory
{
    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'description' => $this->faker->sentence(),
            'company_id' => Company::factory(),
        ];
    }
}