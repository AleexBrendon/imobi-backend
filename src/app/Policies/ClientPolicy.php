<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;

class ClientPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->company_id !== null;
    }

    public function view(User $user, Client $client): bool
    {
        return $this->sameCompany($user, $client);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'funcionario']);
    }

    public function update(User $user, Client $client): bool
    {
        return $this->sameCompany($user, $client)
            && in_array($user->role, ['admin', 'funcionario']);
    }

    public function delete(User $user, Client $client): bool
    {
        return $this->sameCompany($user, $client)
            && $user->role === 'admin';
    }

    private function sameCompany(User $user, Client $client): bool
    {
        return $user->company_id === $client->company_id;
    }
}