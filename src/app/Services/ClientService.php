<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Activity;

class ClientService
{
    public function getAll($companyId)
    {
        return Client::where('company_id', $companyId)->get();
    }

    public function create(array $data)
    {
        $companyId = $data['company_id'] ?? 1;

        $client = Client::create($data);

        Activity::create([
            'client_id' => $client->id,
            'company_id' => $data['company_id'],
            'user_id' => $data['user_id'],
            'description' => 'Cliente criado'
        ]);

        return $client;
    }

    public function update(Client $client, array $data)
    {
        $client->update($data);

        return $client;
    }

    public function updateStatus($id, $status, $companyId = 1)
    {
        $client = Client::where('id', $id)
            ->where('company_id', $companyId)
            ->firstOrFail();

        $client->update(['status' => $status]);

        return $client;
    }

    public function attachProperty($clientId, array $data, $companyId)
    {
        $client = Client::where('id', $clientId)
            ->where('company_id', $companyId)
            ->firstOrFail();

        $client->properties()->attach($data['property_id'], [
            'status' => $data['status'] ?? null,
            'notes' => $data['notes'] ?? null,
        ]);

        return true;
    }

    public function updateProperty($clientId, $propertyId, array $data, $companyId)
    {
        $client = Client::where('id', $clientId)
            ->where('company_id', $companyId)
            ->firstOrFail();

        $client->properties()->updateExistingPivot($propertyId, [
            'status' => $data['status'] ?? null,
            'notes' => $data['notes'] ?? null,
        ]);

        return true;
    }
}
