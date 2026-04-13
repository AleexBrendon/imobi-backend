<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Activity;
use Illuminate\Support\Facades\DB;

class ClientService
{
    public function getAll()
    {
        return Client::query()
            ->latest()
            ->paginate(10);
    }

    public function create(array $data): Client
    {
        return DB::transaction(function () use ($data) {

            $client = Client::create($data);

            Activity::create([
                'description' => 'Cliente criado',
                'user_id' => $data['user_id'],
                'client_id' => $client->id
            ]);

            return $client;
        });
    }

    public function update(Client $client, array $data): Client
    {
        $client->update($data);

        Activity::create([
            'description' => 'Cliente atualizado',
            'user_id' => $client->user_id,
            'client_id' => $client->id
        ]);

        return $client->refresh();
    }

    public function updateStatus(int $id, string $status): Client
    {
        $client = Client::findOrFail($id);

        $client->update([
            'status' => $status
        ]);

        Activity::create([
            'description' => "Status alterado para {$status}",
            'user_id' => $client->user_id,
            'client_id' => $client->id
        ]);

        return $client->refresh();
    }
}