<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\ClientCreated;
use App\Listeners\CreateClientActivity;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ClientCreated::class => [
            CreateClientActivity::class,
        ],
    ];
}