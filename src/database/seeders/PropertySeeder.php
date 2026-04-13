<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        Property::create([
            'title' => 'Casa moderna',
            'description' => '3 quartos, piscina',
            'price' => 450000,
            'address' => 'Rua A, 123',
            'user_id' => 1
        ]);

        Property::create([
            'title' => 'Apartamento central',
            'description' => '2 quartos, perto do centro',
            'price' => 300000,
            'address' => 'Av Central, 456',
            'user_id' => 1
        ]);
    }
}