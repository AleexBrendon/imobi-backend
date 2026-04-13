<?php

namespace App\Listeners;

use App\Events\ClientCreated;
use App\Models\Activity;

class CreateClientActivity
{
    public function handle(ClientCreated $event): void
    {
        Activity::create([
            'description' => 'Cliente criado',
            'user_id' => $event->client->user_id,
            'client_id' => $event->client->id,
        ]);
    }
}