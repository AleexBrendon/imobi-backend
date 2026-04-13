<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;

class ClientPolicy
{
    public function view(User $user, Client $client)
    {
        return $user->id === $client->user_id;
    }
}
