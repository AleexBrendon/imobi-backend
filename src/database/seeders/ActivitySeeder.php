<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;
use App\Models\Client;
use App\Models\User;

class ActivitySeeder extends Seeder
{
    public function run()
    {
        $user = User::first();

        foreach (Client::all() as $client) {
            Activity::create([
                'description' => fake()->sentence(),
                'user_id' => $user->id,
                'client_id' => $client->id,
                'company_id' => $user->company_id
            ]);
        }
    }
}