<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'file_path' => 'documents/test.pdf',
            'type' => 'pdf',
            'status' => 'pending',
            'expires_at' => now()->addDays(30)
        ];
    }
}
