<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PropertyTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_property()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/properties', [
            'title' => 'Casa',
            'description' => 'Top',
            'price' => 150000,
            'address' => 'Rua A',
            'user_id' => $user->id
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment(['title' => 'Casa']);
    }

    public function test_list_properties()
    {
        Property::factory()->count(3)->create();

        $response = $this->getJson('/api/properties');

        $response->assertStatus(200);
    }

    public function test_update_property()
    {
        $property = Property::factory()->create();

        $response = $this->putJson("/api/properties/{$property->id}", [
            'title' => 'Atualizado'
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['title' => 'Atualizado']);
    }

    public function test_delete_property()
    {
        $property = Property::factory()->create();

        $response = $this->deleteJson("/api/properties/{$property->id}");

        $response->assertStatus(204);
    }
}
