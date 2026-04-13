<?php

namespace App\Services;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentService
{
    public function list()
    {
        return Document::latest()->get();
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
            'client_id' => 'required'
        ]);

        $path = $request->file('file')->store('documents');

        return Document::create([
            'client_id' => $request->client_id,
            'file_path' => $path,
            'type' => $request->file('file')->extension(),
            'status' => 'pending'
        ]);
    }

    public function find($id)
    {
        return Document::findOrFail($id);
    }

    public function delete($id)
    {
        Document::findOrFail($id)->delete();
    }
}
