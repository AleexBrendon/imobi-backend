<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Client;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

class DocumentTest extends TestCase
{
    use RefreshDatabase;

    public function test_upload_document()
    {
        Storage::fake('local');

        $user = $this->authenticate();

        $client = Client::factory()->create([
            'company_id' => $user->company_id
        ]);

        $file = UploadedFile::fake()->create('doc.pdf', 100);

        $response = $this->postJson('/api/documents', [
            'file' => $file,
            'client_id' => $client->id
        ]);

        $response->assertStatus(200);
    }

    public function test_list_documents()
    {
        $this->authenticate();

        $response = $this->getJson('/api/documents');

        $response->assertStatus(200);
    }

    public function test_delete_document()
    {
        Storage::fake('local');

        $user = $this->authenticate();

        $client = Client::factory()->create([
            'company_id' => $user->company_id
        ]);

        $file = UploadedFile::fake()->create('doc.pdf', 100);

        $doc = $this->postJson('/api/documents', [
            'file' => $file,
            'client_id' => $client->id
        ])->json();

        $response = $this->deleteJson("/api/documents/{$doc['id']}");

        $response->assertStatus(204);
    }
}
