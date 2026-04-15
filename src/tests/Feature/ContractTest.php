<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Client;
use App\Models\Property;
use App\Models\Contract;
use Laravel\Sanctum\Sanctum;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_contract()
    {
        $user = $this->authenticate();

        $client = Client::factory()->create([
            'company_id' => $user->company_id
        ]);

        $property = Property::factory()->create([
            'company_id' => $user->company_id
        ]);

        $response = $this->postJson('/api/contracts', [
            'client_id' => $client->id,
            'property_id' => $property->id,
            'title' => 'Contrato Teste',
            'expires_at' => now()->addDays(30),
            'status' => 'active'
        ]);

        $response->assertStatus(201);
    }

    public function test_list_contracts()
    {
        $user = $this->authenticate();

        Contract::factory()->count(2)->create([
            'company_id' => $user->company_id
        ]);

        $response = $this->getJson('/api/contracts');

        $response->assertStatus(200);
    }

    public function test_update_contract()
    {
        $user = $this->authenticate();

        $contract = Contract::factory()->create([
            'company_id' => $user->company_id
        ]);

        $response = $this->putJson("/api/contracts/{$contract->id}", [
            'title' => 'Atualizado'
        ]);

        $response->assertStatus(200);
    }

    public function test_delete_contract()
    {
        $user = $this->authenticate();

        $contract = Contract::factory()->create([
            'company_id' => $user->company_id
        ]);

        $response = $this->deleteJson("/api/contracts/{$contract->id}");

        $response->assertStatus(204);
    }
}
