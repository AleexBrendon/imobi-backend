<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contract;
use App\Models\Client;
use App\Models\Property; 

class ContractSeeder extends Seeder
{
    public function run()
    {
        foreach (Client::all() as $client) {
            $property = Property::inRandomOrder()->first();

            Contract::create([
                'client_id' => $client->id,
                'property_id' => $property->id,
                'title' => 'Contrato ' . fake()->word(),
                'expires_at' => now()->addMonths(6),
                'status' => 'active',
                'company_id' => $client->company_id
            ]);
        }
    }
}
