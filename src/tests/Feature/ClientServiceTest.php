<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Client;
use App\Models\User;
use App\Models\Activity;
use App\Services\ClientService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientServiceTest extends TestCase
{
    use RefreshDatabase;

    protected ClientService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = app(ClientService::class);
    }

    public function test_it_creates_a_client_and_activity()
    {
        $user = $this->authenticate();

        $data = [
            'name' => 'João Teste',
            'email' => 'joao@test.com',
            'user_id' => $user->id,
            'company_id' => $user->company_id
        ];

        $client = $this->service->create($data);

        $this->assertDatabaseHas('clients', [
            'email' => 'joao@test.com'
        ]);

        $this->assertDatabaseHas('activities', [
            'client_id' => $client->id,
            'description' => 'Cliente criado'
        ]);
    }

    public function test_it_updates_client()
    {
        $client = Client::factory()->create([
            'company_id' => $this->authenticate()->company_id
        ]);

        $this->service->update($client, [
            'name' => 'Novo Nome'
        ]);

        $this->assertDatabaseHas('clients', [
            'id' => $client->id,
            'name' => 'Novo Nome'
        ]);
    }

    public function test_it_updates_status()
    {
        $client = Client::factory()->create([
            'company_id' => $this->authenticate()->company_id
        ]);

        $this->service->updateStatus($client->id, 'closed');

        $this->assertDatabaseHas('clients', [
            'id' => $client->id,
            'status' => 'closed'
        ]);
    }
}
