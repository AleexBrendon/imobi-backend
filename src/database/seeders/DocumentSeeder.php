<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Document;
use App\Models\Client;

class DocumentSeeder extends Seeder
{
    public function run()
    {
        foreach (Client::all() as $client) {
            Document::create([
                'client_id' => $client->id,
                'file_path' => 'docs/teste.pdf',
                'type' => 'pdf',
                'status' => 'pending',
                'expires_at' => now()->addYear(),
                'company_id' => $client->company_id
            ]);
        }
    }
}
