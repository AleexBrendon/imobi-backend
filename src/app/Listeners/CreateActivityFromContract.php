<?php

namespace App\Listeners;

use App\Events\ContractCreated;
use App\Models\Activity;

class CreateActivityFromContract
{
    public function handle(ContractCreated $event): void
    {
        Activity::create([
            'description' => 'Contrato criado',
            'user_id' => $event->contract->client->user_id,
            'client_id' => $event->contract->client_id,
        ]);
    }
}
