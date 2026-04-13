<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Property;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        Client::create([
            'name' => 'João Silva',
            'email' => 'joao@email.com',
            'phone' => '99999-9999',
            'status' => 'prospect',
            'user_id' => 1
        ]);

        Client::create([
            'name' => 'Maria Souza',
            'email' => 'maria@email.com',
            'phone' => '88888-8888',
            'status' => 'visit',
            'user_id' => 1
        ]);

        $client = Client::first();
        $property = Property::first();

        if ($client && $property) {
            $client->properties()->syncWithoutDetaching([
                $property->id => [
                    'status' => 'interested',
                    'notes' => 'Gostou bastante'
                ]
            ]);
        }
    }
}
