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

    public function index(Request $request)
    {
        return $this->service->getAll($request->user()->company_id);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['company_id'] = $request->user()->company_id;

        return $this->service->create($data);
    }

    public function show(Request $request, Client $client)
    {
        $this->authorizeClient($request, $client);

        return $client;
    }

    public function update(Request $request, Client $client)
    {
        $this->authorizeClient($request, $client);

        return $this->service->update($client, $request->all());
    }

    public function destroy(Request $request, Client $client)
    {
        $this->authorizeClient($request, $client);

        $client->delete();

        return response()->noContent();
    }

    public function updateStatus(Request $request, $id)
    {
        return $this->service->updateStatus(
            $id,
            $request->status,
            $request->user()->company_id
        );
    }

    public function attachProperty(Request $request, $id)
    {
        $this->service->attachProperty(
            $id,
            $request->all(),
            $request->user()->company_id
        );

        return response()->noContent();
    }

    public function updateProperty(Request $request, $clientId, $propertyId)
    {
        $this->service->updateProperty(
            $clientId,
            $propertyId,
            $request->all(),
            $request->user()->company_id
        );

        return response()->noContent();
    }

    private function authorizeClient(Request $request, Client $client)
    {
        if ($client->company_id !== $request->user()->company_id) {
            abort(403);
        }
    }
}
