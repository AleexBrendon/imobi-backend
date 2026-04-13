<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'John Doe',
            'email' => 'john@test.com',
            'password' => 'password123'
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'name',
                'email',
                'created_at',
                'updated_at'
            ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john@test.com'
        ]);
    }

    public function test_user_can_login_and_receive_token()
    {
        User::create([
            'name' => 'John',
            'email' => 'john@test.com',
            'password' => bcrypt('password123')
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'john@test.com',
            'password' => 'password123'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'user',
                'token'
            ]);
    }

    public function test_protected_route_requires_auth()
    {
        $response = $this->getJson('/api/clients');

        $response->assertStatus(401);
    }
}