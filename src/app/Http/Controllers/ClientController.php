<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Activity;
use Illuminate\Support\Facades\DB;
use App\Events\ClientCreated;

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

            event(new ClientCreated($client));

            return $client;
        });
    }

    public function update(Client $client, array $data): Client
    {
        $client->update($data);

        event(new ClientCreated($client));

        return $client->refresh();
    }

    public function updateStatus(int $id, string $status): Client
    {
        $client = Client::findOrFail($id);

        $client->update([
            'status' => $status
        ]);

        event(new ClientCreated($client));

        return $client->refresh();
    }

    public function attachProperty(int $clientId, array $data): void
    {
        $client = Client::findOrFail($clientId);

        $client->properties()->attach($data['property_id'], [
            'status' => $data['status'] ?? null,
            'notes' => $data['notes'] ?? null
        ]);

        event(new ClientCreated($client));
    }

    public function updateProperty(int $clientId, int $propertyId, array $data): void
    {
        $client = Client::findOrFail($clientId);

        $client->properties()->updateExistingPivot($propertyId, [
            'status' => $data['status'] ?? null,
            'notes' => $data['notes'] ?? null
        ]);

        event(new ClientCreated($client));
    }
}
