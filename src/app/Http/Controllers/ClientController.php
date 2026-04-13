<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $service;

    public function __construct(ClientService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->getAll();
    }

    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    public function show(Client $client)
    {
        return $client;
    }

    public function update(Request $request, Client $client)
    {
        return $this->service->update($client, $request->all());
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return response()->noContent();
    }

    public function updateStatus(Request $request, $id)
    {
        return $this->service->updateStatus($id, $request->status);
    }

    public function attachProperty(Request $request, $id)
    {
        $this->service->attachProperty($id, $request->all());
        return response()->noContent();
    }

    public function updateProperty(Request $request, $clientId, $propertyId)
    {
        $this->service->updateProperty($clientId, $propertyId, $request->all());
        return response()->noContent();
    }
}
