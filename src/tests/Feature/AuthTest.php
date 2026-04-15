<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register()
    {
        $response = $this->postJson('/api/register', [
            'company_name' => 'Empresa Teste',
            'name' => 'John Doe',
            'email' => 'john@test.com',
            'password' => 'password123'
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'user' => [
                    'id',
                    'name',
                    'email',
                    'role',
                    'company_id'
                ]
            ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john@test.com'
        ]);

        $this->assertDatabaseHas('companies', [
            'name' => 'Empresa Teste'
        ]);
    }

    public function test_user_can_login_and_receive_token()
    {
        $company = Company::create([
            'name' => 'Empresa Teste'
        ]);

        User::create([
            'name' => 'John',
            'email' => 'john@test.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'company_id' => $company->id
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
