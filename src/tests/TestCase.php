<?php

namespace Tests;

use App\Models\User;
use App\Models\Company;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function authenticate($role = 'admin')
    {
        $company = Company::create([
            'name' => 'Empresa Teste'
        ]);

        $user = User::factory()->create([
            'role' => $role,
            'company_id' => $company->id
        ]);

        Sanctum::actingAs($user);

        return $user;
    }
}
