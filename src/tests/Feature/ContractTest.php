<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Client;
use App\Models\Property;
use App\Models\Contract;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_contract()
    {
        $client = Client::factory()->create();
        $property = Property::factory()->create();
        
        $response = $this->postJson('/api/contracts', [
            'client_id' => 1,
            'property_id' => 1,
            'title' => 'Contrato Teste',
            'expires_at' => now()->addDays(30),
            'status' => 'active'
        ]);

        $response->assertStatus(201);
    }

    public function test_list_contracts()
    {
        Contract::factory()->count(2)->create();

        $response = $this->getJson('/api/contracts');

        $response->assertStatus(200);
    }

    public function test_update_contract()
    {
        $contract = Contract::factory()->create();

        $response = $this->putJson("/api/contracts/{$contract->id}", [
            'title' => 'Atualizado'
        ]);

        $response->assertStatus(200);
    }

    public function test_delete_contract()
    {
        $contract = Contract::factory()->create();

        $response = $this->deleteJson("/api/contracts/{$contract->id}");

        $response->assertStatus(204);
    }
}
