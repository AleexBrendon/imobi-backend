<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Property;
use Illuminate\Support\Facades\DB;

class ClientPropertySeeder extends Seeder
{
    public function run()
    {
        $clients = Client::all();
        $properties = Property::all();

        foreach ($clients as $client) {
            $property = $properties->random();

            DB::table('client_property')->insert([
                'client_id' => $client->id,
                'property_id' => $property->id,
                'status' => 'interested',
                'notes' => fake()->sentence(),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
